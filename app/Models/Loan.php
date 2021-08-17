<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Loan extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','creation_date','loan_type_id','sub_account_id',
    'rate','start_date', 'amount', 'fees_quantity', 'active', 'billing_cycle_id','doc_entry'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function billing_cycle(){

        return $this->belongsTo(BillingCycle::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }


    public function balanceDue(){
        $deuda = $this->transactions->whereNotIn('transaction_type_id',[1])->where('sub_account_id', $this->client->sub_account_id)->sum('amount');
        return $deuda;
    }

    // Atributos
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getNextPaymentDateAttribute(){

        return Carbon::parse($this->start_date)->formatLocalized('%d %B %Y');
    }

    public function loan_info(){

        $cycle = $this->billing_cycle;
        $start_date = $this->start_date;
        $info = array();
        $day =0;
        $tasa =0;
        $deuda = $this->amount;
        //Calculo de la tasa

        $cuota =0;
        $interes =0;
        $atrasos =0;

        if($this->loan_type_id == 1 ){

            if($cycle->type == 1){
                $tasa = (($this->rate/100)/365)*$cycle->value ;
            }else if ($cycle->type == 2){
                $tasa = (($this->rate/100)/24);
            }else{
                $tasa = ($this->rate/100)/12;
            }
        }
        else if($this->loan_type_id == 2){
            $interes = (($this->rate*$this->fees_quantity)-$deuda)/$this->fees_quantity;
            $cuota = $this->rate;
        }else{
            $tasa = ($this->rate/100);
        }


        $contador = 1;
        /*
        while ($contador <= $this->fees_quantity && $this->loan_type_id != 3) {
            $contador++;

            if($this->loan_type_id == 1 ){

                $cuota = ( $this->amount *$tasa*(pow((1+$tasa),($this->fees_quantity))))/((pow((1+$tasa),($this->fees_quantity)))-1);

                $info[$start_date]['monthly'] = $cuota;
                $info[$start_date]['interest'] = $deuda * $tasa;
                $info[$start_date]['capital'] = $cuota-$interes;
                $deuda -= $cuota - ($deuda * $tasa);
                if( date("Y-m-d",strtotime($start_date)) <= date("Y-m-d")){
                    $atrasos +=$cuota;
                }
            }
            else if($this->loan_type_id == 2){ // San

                $info[$start_date]['monthly'] = $cuota;
                $info[$start_date]['interest'] = $interes;
                $info[$start_date]['capital'] = $cuota-$interes;
                if( date("Y-m-d",strtotime($start_date)) <= date("Y-m-d")){
                    $atrasos +=$cuota;
                }
            }


            if($cycle->type == 1){
                $start_date = date("Y-m-d",strtotime($start_date."+$cycle->value days"));
            }else if ($cycle->type == 2){
                $day =date("d",strtotime($start_date));

                if($day==15){
                    $start_date = date("Y-m-30",strtotime($start_date."+$cycle->value days"));

                }else{
                    $start_date = date("Y-m-15",strtotime($start_date."+1 month"));
                }
            }

        }*/

        while ($start_date <= date("Y-m-d") && $this->loan_type_id == 3 ) {

            $deuda = $this->transactions->whereIn('transaction_type_id',[4,2])
                    ->where('sub_account_id', $this->client->sub_account_id)
                    ->where('transaction_date','<=',$start_date )
                    ->sum('amount');

            $info[$contador]['monthly'] = ($tasa *$deuda );
            $info[$contador]['interest'] = ($tasa *$deuda );
            $info[$contador]['capital'] = 0;
            $info[$contador]['capital_due'] = $deuda;
            $info[$contador]['date'] = $start_date;

            if($cycle->type == 1){
                $start_date = date("Y-m-d",strtotime($start_date."+$cycle->value days"));
            }else if ($cycle->type == 2){
                $day =date("d",strtotime($start_date));

                if($day==15){
                    $start_date = date("Y-m-30",strtotime($start_date."+$cycle->value days"));

                }else{
                    $start_date = date("Y-m-15",strtotime($start_date."+1 month"));
                }
            }

            $contador++;
        }

        $totalInterest=0;
        foreach ($info as $key => $value) {
            $totalInterest+= $value['interest'];
        }
        $totalInterestPaid = $this->transactions->whereIn('transaction_type_id',[5])
        ->where('sub_account_id', $this->client->sub_account_id)
        ->sum('amount');
        $totalPaid = $this->transactions->whereIn('transaction_type_id',[4])
        ->where('sub_account_id', $this->client->sub_account_id)
        ->sum('amount');

        $info[0]['total_interest'] =$totalInterest;
        $info[0]['total_interest_paid'] =abs($totalInterestPaid);
        $info[0]['total_interest_due'] =$totalInterest+$totalInterestPaid;
        $info[0]['deuda'] =$this->amount+$totalPaid;
        $info[0]['total_capital_paid'] = abs($totalPaid);
        $info[0]['atrasos'] =($totalInterest+$totalInterestPaid);
        $info[0]['next_fee'] =0;
        if(($this->amount+$totalPaid)>0){
            $info[0]['next_fee'] =($totalInterest+$totalInterestPaid)+ (($this->amount+$totalPaid)*$tasa);
        }
        return $info;


    }
    public function amount_due(){

        $cycle = $this->billing_cycle;
        $start_date =$this->start_date;
        $dates = array();
        $mensualidad = $this->fees();
        while ( $start_date  <= date("Y-m-d")) {



        }

    }

    public function fees() {

        if($this->loan_type_id == 1 ){
            $tasa = ($this->rate/100)/12;
            $deuda = $this->amount;

            $mensualidad = ( $this->amount *$tasa*(pow((1+$tasa),($this->fees_quantity))))/((pow((1+$tasa),($this->fees_quantity)))-1);
            $interesr = $deuda * $tasa;
            $deuda -= $mensualidad - $interesr ;
            return ($deuda  * $tasa);
        }
        else if($this->loan_type_id == 2){ // San

            return $this->rate;
        }
        else if($this->loan_type_id == 3){ // Redito
            return $this->amount*($this->rate/100);
        }

        return 0;
    }
    public function getNextPaymentAmountAttribute(){


        // return $this->balanceDue();
        // Cuota Prestamo
        $info = $this->loan_info();

        return number_format( $info[0]['next_fee'],2);

/*

Cuota = (Monto * (TEM x (1 + TEM) ^ n)) / ((1 + TEM) ^ n) - 1)

siendo: Monto (valor a ser prestado), n (numero de meses), TEM (Tasa Efectiva Mensual)
*/

    }
}
