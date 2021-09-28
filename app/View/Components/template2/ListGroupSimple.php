<?php

namespace App\View\Components\template2;

use Illuminate\View\Component;

class ListGroupSimple extends Component
{
    public $icon, $text, $link, $subtext;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $text, $link, $subtext)
    {
        $this->icon = $icon;
        $this->text = $text;
        $this->link = $link;
        $this->subtext = $subtext;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.template2.list-group-simple');
    }
}
