<?php

namespace App\View\Components\template2;

use Illuminate\View\Component;

class AccordionList extends Component
{
    public $heading, $parentList, $iconTitle, $isOpen;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($heading, $parentList = 'accordion-list', $iconTitle = null, $isOpen = false)
    {
        $this->heading = $heading;
        $this->parentList = $parentList;
        $this->iconTitle = $iconTitle;
        $this->isOpen = $isOpen;
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
