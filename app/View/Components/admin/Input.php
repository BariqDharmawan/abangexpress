<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Input extends Component
{
    public $name, $label, $value, $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $value = null, $type)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.input');
    }
}
