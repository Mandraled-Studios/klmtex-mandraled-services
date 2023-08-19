<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sidebar_index extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public int $pid, public int $step, public bool $newproduct)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar_index')->with([
            "pid" => $pid,
            "step" => $step,
            "newproduct" => $newproduct
        ]);
    }
}
