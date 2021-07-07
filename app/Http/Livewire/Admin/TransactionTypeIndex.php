<?php

namespace App\Http\Livewire\Admin;

use App\Models\TransactionType;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionTypeIndex extends Component
{

    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'desc';

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $transaction_types = TransactionType::where('description','like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.admin.transaction-type-index', compact('transaction_types'));
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
}
