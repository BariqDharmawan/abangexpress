<?php

namespace App\View\Components\template2;

use Illuminate\View\Component;

class SectionTitle extends Component
{
    public $heading, $desc;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($heading, $desc = null)
    {
        $this->heading = $heading;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template2.section-title');
    }
}
