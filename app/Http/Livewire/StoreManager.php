<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Company;
use Livewire\Component;


class StoreManager extends Component
{
    use WithFileUploads;

    public Company $company;
    public $saved = false;
    public $logo;
    public $social1_icon;
    public $social2_icon;
    
    public function mount() {
        $this->company = Company::first();   
    }

    public function hydrate() {
        $this->company = Company::first(); 
        $this->saved = true;  
    }

    protected $rules = [
        'company.company_name' => 'required|string|min:3|max:255',
        'company.gstin' => 'required|string|min:8|max:32',
        'logo' => 'nullable|sometimes|mimes:jpg,jpeg,png,gif,svg|max:256',
        'company.website' => 'required|url|min:4|max:255',
        'company.email' => 'required|email|max:255',
        'company.phone' => 'required|string|min:10|max:15',
        'company.facebook' => 'sometimes|url|max:255',
        'company.twitter' => 'sometimes|url|max:255',
        'company.instagram' => 'sometimes|url|max:255',
        'company.linkedin' => 'sometimes|url|max:255',
        'company.youtube' => 'sometimes|url|max:255',
        'company.whatsapp' => 'sometimes|string|max:255',
        'company.social1' => 'sometimes|string|max:255',
        'company.social1_url' => 'sometimes|url|max:255',
        'social1_icon' => 'nullable|sometimes|mimes:jpg,jpeg,png,gif,svg|max:256',
        'company.social2' => 'sometimes|string|max:255',
        'company.social2_url' => 'sometimes|url|max:255',
        'social2_icon' => 'nullable|sometimes|mimes:jpg,jpeg,png,gif,svg|max:256',
        'company.social_style' => 'sometimes|string|max:32',
    ];
 
    public function save()
    {
        $this->validate();
        //Logo
        if($this->logo) {
            $logo_file_name = $this->company->company_name.'-'.time();
            $logo_file_ext = $this->logo->getClientOriginalExtension();
            $this->logo->storeAs('public/images/logos', $logo_file_name.'.'.$logo_file_ext);
            $this->company->logo = '/uploads/images/logos/'.$logo_file_name.'.'.$logo_file_ext;
        }

        //Social 1
        if($this->social1_icon) {
            $social1_file_name = $this->company->company_name.'-'.time();
            $social1_file_ext = $this->social1_icon->getClientOriginalExtension();
            $this->social1_icon>storeAs('public/images/socials', $social1_file_name.'.'.$social1_file_ext);
            $this->company->social1_icon = '/uploads/images/socials/'.$social1_file_name.'.'.$social1_file_ext;
        }

        //Social 2
        if($this->social2_icon) {
            $social2_file_name = $this->company->company_name.'-'.time();
            $social2_file_ext = $this->social2_icon->getClientOriginalExtension();
            $this->social2_icon->storeAs('public/images/socials', $social2_file_name.'.'.$social2_file_ext);
            $this->company->social2_icon = '/uploads/images/socials/'.$social2_file_name.'.'.$social2_file_ext;
        }

        $this->company->save();
        $this->saved = true;
    }
    
    public function render()
    {
        return view('livewire.store-manager');
    }
}
