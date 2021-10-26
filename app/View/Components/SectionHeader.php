<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SectionHeader extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $text, $desc;

    public function __construct($text, $desc = null)
    {
        $this->text = $text;
        $this->desc = $desc;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.section-header');
    }
}
