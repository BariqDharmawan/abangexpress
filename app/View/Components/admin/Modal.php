<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Modal extends Component
{
    public $heading, $id, $size, $isCloseAble;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($heading, $id, $size=null, $isCloseAble = true)
    {
        $this->heading = $heading;
        $this->id = $id;
        $this->size = $size;
        $this->isCloseAble = $isCloseAble;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.modal.index');
    }
}
