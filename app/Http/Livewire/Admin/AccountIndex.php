<?php

namespace App\Http\Livewire\Admin;

use App\Models\Account;
use Livewire\Component;
use Livewire\WithPagination;

class AccountIndex extends Component
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

        $accounts = Account::where('description','like', '%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.admin.account-index', compact('accounts'));
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
