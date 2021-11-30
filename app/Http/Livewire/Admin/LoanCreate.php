<?php

namespace App\Http\Livewire\Admin;

use App\Models\BillingCycle;
use App\Models\Client;
use App\Models\Loan;
use App\Models\LoanCategory;
use App\Models\LoanType;
use App\Models\SubAccount;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LoanCreate extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';


    public $current_client;
    public $searh_client;
    public $loanCategory;

    // Propiedades
    public $client_id;
    public $loanTypeId;
    public $sub_account_id;
    public $rate;
    public $start_date;
    public $amount;
    public $fees_quantity;
    public $billing_cycle_id;
    public $cuota;
    public $subAccountId;
    public $creation_date;

    public $showClienteList = false;
    public function render()
    {
        $clients = Client::with('sub_account','contact', 'address')
        ->where('first_name','like', '%'.$this->searh_client.'%')
        ->orWhere('last_name','like', '%'.$this->searh_client.'%')
        ->orWhere('identification','like', '%'.$this->searh_client.'%')
        ->paginate(10);

        $loanCategories = LoanCategory::orderBy('description')->get();
        $loanTypes = LoanType::orderBy('description')->get();
        $billingCycles = BillingCycle::orderBy('description')->get();
        $subAccounts = SubAccount::where('account_id',1)->orderBy('description')->get();

        return view('livewire.admin.loan-create', compact('clients', 'loanCategories', 'loanTypes','billingCycles','subAccounts'));
    }

    public function showModalClient(){
        $this->showClienteList = !$this->showClienteList;
    }

    public function selectClient(Client $client){

        $this->current_client = $client;
        $this->client_id = $client->id;
        $this->sub_account_id = $client->sub_account_id;
        $this->showClienteList = false;
    }
    public function updatedLoanCategory(){

        $data = LoanCategory::find($this->loanCategory);
        $this->loanTypeId = $data->loan_type_id??0;
        $this->fees_quantity = $data->duration??0;
        $this->billing_cycle_id = $data->billing_cycle_id??0;
        $this->rate = $data->period_rate??0;

    }
    public function updatedAmount(){
        $this->calcularCuota();
    }
    public function updatedLoanTypeId(){
        $this->calcularCuota();
    }
    public function updatedFeesQuantity(){
        $this->calcularCuota();
    }
    public function updatedRate(){
        $this->calcularCuota();
    }
    public function calcularCuota(){


        if ($this->loanTypeId ==1){


        }else if ($this->loanTypeId ==2){

                if($this->rate <=0){
                    session()->flash('message', 'Debes Colocar la tasa ejemplo (10)');
                    $this->cuota=0;
                }
                else if($this->fees_quantity<=0){
                    session()->flash('message', 'La cantidad de pagos debe ser mayor a zero');
                    $this->cuota=0;
                } else if($this->amount<=0){
                    session()->flash('message', 'El monto del financiamiento debe ser mayor que zero');
                    $this->cuota=0;
                }else{
                    $this->cuota = ( ($this->amount*($this->rate/100)) ) ;
                }

        }else if($this->loanTypeId == 3){
            $this->fees_quantity =0;

            if($this->rate <=0){
                session()->flash('message', 'Debes Colocar la tasa ejemplo (15)');
                $this->cuota=0;
            }else if($this->amount<=0){
                session()->flash('message', 'El monto del financiamiento debe ser mayor que zero');
                $this->cuota=0;
            }else{
                $this->cuota =  ($this->amount*($this->rate/100)) ;
            }
        }
    }

    /// Info de Salvar
    protected $rules = [
        'client_id' => 'required',
        'loanTypeId' => 'required',
        'start_date' => 'required|date',
        'amount' => "required",
        'loanCategory' => "required",
        'subAccountId' => 'required|numeric'
    ];
    protected $validationAttributes = [
        'start_date' => 'Fecha primera cuota',
        'loanTypeId' => 'Categoria de prestamo',
        'subAccountId' => 'cuenta caja/banco',
        'loanCategory' => 'Plantilla de prestamo'
    ];

    public function save()
    {

        if($this->amount > $this->current_client->credit_limit){


            session()->flash('message', 'El monto sobre pasa el limite por prestamos de este cliente ('.number_format($this->current_client->credit_limit,2).')');
            return;
        }
        $this->validate();
        DB::beginTransaction();

        try
        {
            $loan = Loan::create(['client_id'=>$this->client_id,'loan_type_id' => $this->loanTypeId ,'sub_account_id' =>$this->subAccountId ,
            'rate'=>$this->rate ,'start_date' => $this->start_date, 'amount' => $this->amount,
            'fees_quantity' => $this->fees_quantity, 'active' => 1, 'billing_cycle_id' => $this->billing_cycle_id,
            'creation_date'=> $this->creation_date]);

            // Credito a Cuenta
            Transaction::create([
                'loan_id' => $loan->id,'transaction_date'=> $loan->creation_date,
                'description' => 'Desembolso a prestamo '.
                ' para el Sr/Sra'. $this->current_client->first_name.' '. $this->current_client->last_name,
                'sub_account_id'=> $loan->sub_account_id,'transaction_type_id'=>1,'amount' =>($loan->amount*-1 ),'active' =>1
            ]);

            //Debito a cliente
            Transaction::create([
                'loan_id' => $loan->id,'transaction_date'=> $loan->creation_date,
                'description' => 'Desembolso a prestamo'.
                ' para el Sr/Sra'. $this->current_client->first_name.' '. $this->current_client->last_name,
                'sub_account_id'=> $this->current_client->sub_account_id,'transaction_type_id'=>2,'amount' =>$loan->amount ,'active' =>1
            ]);
            $loan->doc_entry = Loan::count();
            $loan->update();
            $this->calculate_old_interest($loan);
            DB::commit();
            return redirect()->to('/admin/loans');
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('message',$e->getMessage().'Algo salio mal al tratar de crear prestamo');

        }


    }

    private function calculate_old_interest(Loan $loan){

        $ini = $loan->start_date;
        $cycle = $loan->billing_cycle;
        $monto = 0;
        $tasa =0;
        if($loan->loan_type_id == 1 ){

            if($cycle->type == 1){
                $tasa = (($loan->rate/100)/365)*$cycle->value ;
            }else if ($cycle->type == 2){
                $tasa = (($loan->rate/100)/24);
            }else{
                $tasa = ($this->rate/100)/12;
            }
        }
        else if($loan->loan_type_id == 2){
           // $interes = (($loan->rate*$loan->fees_quantity)-$deuda)/$loan->fees_quantity;
            $cuota = $loan->rate;
        }else{
            $tasa = ($loan->rate/100);
        }

        while (date("Y-m-d",strtotime($ini)) <= date("Y-m-d")) {

            if($loan->loan_type_id == 1 ){

              /*  $cuota = ( $this->amount *$tasa*(pow((1+$tasa),($this->fees_quantity))))/((pow((1+$tasa),($this->fees_quantity)))-1);

                $info[$start_date]['monthly'] = $cuota;
                $info[$start_date]['interest'] = $deuda * $tasa;
                $info[$start_date]['capital'] = $cuota-$interes;
                $deuda -= $cuota - ($deuda * $tasa);
                if( date("Y-m-d",strtotime($start_date)) <= date("Y-m-d")){
                    $atrasos +=$cuota;
                }*/
            }
            else if($loan->loan_type_id == 2){ // San

               /* $info[$start_date]['monthly'] = $cuota;
                $info[$start_date]['interest'] = $interes;
                $info[$start_date]['capital'] = $cuota-$interes;
                if( date("Y-m-d",strtotime($start_date)) <= date("Y-m-d")){
                    $atrasos +=$cuota;
                }*/
            }else{
                $monto = $loan->amount*($tasa );
            }

               //Debito a cliente
            Transaction::create([
                'loan_id' => $loan->id,'transaction_date'=> $ini,
                'description' => 'Intereses Generados',
                'sub_account_id'=> $loan->client->sub_account_id,'transaction_type_id'=>4,'amount' =>$monto ,'active' =>1
            ]);

            if($cycle->type == 1){
                $ini = date("Y-m-d",strtotime($ini."+$cycle->value days"));
            }else if ($cycle->type == 2){
                $day =date("d",strtotime($ini));

                if($day==15){
                    $ini = date("Y-m-30",strtotime($ini."+$cycle->value days"));

                }else{
                    $ini = date("Y-m-15",strtotime($ini."+1 month"));
                }
            }

        }



    }

}
