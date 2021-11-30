<?php

namespace App\Http\Livewire\Admin;

use App\Models\Loan;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class LoanIndex extends Component
{



    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $onlyActive = true;
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {


        $loans = Loan::with('client','transactions','billing_cycle')->select("loans.*", "clients.first_name","clients.last_name")
        ->leftJoin('clients', 'loans.client_id', '=', 'clients.id')
        ->where(function($query) {
            $query->where('clients.first_name','like', '%'.$this->search.'%')
            ->orWhere('clients.last_name','like', '%'.$this->search.'%')
            ->orWhere('clients.identification','like', '%'.$this->search.'%');
        })
        ->where('loans.active', $this->onlyActive?'>':'=', 0 )
        //
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);


        return view('livewire.admin.loan-index', compact('loans'));
    }

    public function order($sort){

        if($this->sort == $sort){
            if($this->direction=='desc'){
                $this->direction ='asc';
            }else{
                $this->direction ='desc';
            }
        }else{
            $this->sort =$sort;
            $this->direction ='asc';
        }
    }
    public function activeAll(){
        $this->onlyActive = !$this->onlyActive;
    }
}
/*
    $constraint = function ($query) {
        $query->where('user_id', auth()->id());
    };

    $forms = Form::where('id','>=',0)
        ->with(['answers' => $constraint])
        ->whereHas('answers', $constraint)
        ->get();*/
