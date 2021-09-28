<?php

namespace App\View\Components\template2;

use Illuminate\View\Component;

class AccordionList extends Component
{
    public $heading, $parentList, $iconTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($heading, $parentList = 'accordion-list', $iconTitle = null)
    {
        $this->heading = $heading;
        $this->parentList = $parentList;
        $this->iconTitle = $iconTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template2.accordion-list');
    }
}
