<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Card extends Component
{
    public $title, $header;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $header = null)
    {
        $this->title = $title;
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.card');
    }
}
