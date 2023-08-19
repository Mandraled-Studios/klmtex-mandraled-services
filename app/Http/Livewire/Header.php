<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Header extends Component
{
    public $company; 

    public function mount($company)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.header')->with([
            'company' => $this->company
        ]);;
    }
}
