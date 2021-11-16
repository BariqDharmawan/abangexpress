<?php

namespace App\View\Components\template1;

use Illuminate\View\Component;

class ListGroupSimple extends Component
{
    public $icon, $text, $link;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $text, $link)
    {
        $this->icon = $icon;
        $this->text = $text;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template1.list-group-simple');
    }
}
