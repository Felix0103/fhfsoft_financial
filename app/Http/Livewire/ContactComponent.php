<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContactComponent extends Component
{

    public $phone;
    public $cell_phone;
    public $email;
    public function render()
    {
        return view('livewire.contact-component');
    }
}
