<?php

namespace App\View\Components;

use App\Models\Company;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $company = Company::first();
        return view('layouts.admin')->with([
            'company' => $company
        ]);
    }
}
