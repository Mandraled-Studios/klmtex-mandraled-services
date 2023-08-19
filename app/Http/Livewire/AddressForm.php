<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Company;
use Livewire\Component;

class AddressForm extends Component
{
    public Company $company;
    public Address $address;
    public $saved = false;

    public function mount() {
        $this->company = Company::first();   
        $this->address = $this->company->address;   
    }

    public function hydrate() {
        $this->company = Company::first(); 
        $this->address = $this->company->address;  
        $this->saved = true;
    }

    protected $rules = [
        'address.country' => 'required|string|max:255',
        'address.zipcode' => 'required|string|min:4|max:12',
        'address.state' => 'required|string|max:255',
        'address.city' => 'required|string|max:255',
        'address.street' => 'required|string|max:255',
        'address.area' => 'required|string|max:255',
        'address.landmark' => 'sometimes|string|max:255',
        'address.floor' => 'sometimes|string|max:255',
        'address.building_no' => 'required|string|max:255',
    ];
 
    public function save()
    {
        $this->validate();
        $this->address->save();
        $this->saved = true;
    }


    public function render()
    {
        return view('livewire.address-form');
    }

}
