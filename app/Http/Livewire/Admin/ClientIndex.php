<?php

namespace App\Http\Livewire\Admin;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;


class ClientIndex extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $includeInactive = false;

    public function updatingIncludeInactive(){
        $this->resetPage();
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function activeAll(){
        $this->includeInactive = !$this->includeInactive;
    }
    public function render()
    {

        $clients = Client::where( function($q){
        $q->where('first_name','like', '%'.$this->search.'%')
        ->orWhere('last_name','like', '%'.$this->search.'%')
        ->orWhere('identification','like', '%'.$this->search.'%');}
        )
        ->where('active', ($this->includeInactive?0:1) )
        ->orderBy($this->sort, $this->direction)
        ->paginate(10);
        return view('livewire.admin.client-index', compact('clients'));
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
