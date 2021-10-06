<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Input extends Component
{
    public $name, $label, $value, $type, $isInlinePick, $id, $isChecked, $isRequired;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name,
        $label = null,
        $value = null,
        $type=null,
        $isInlinePick = false,
        $id = null,
        $isChecked = false,
        $isRequired = false
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;
        $this->isInlinePick = $isInlinePick;
        $this->id = $id;
        $this->isChecked = $isChecked;
        $this->isRequired = $isRequired;
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
