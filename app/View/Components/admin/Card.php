<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Card extends Component
{
    public $title, $header, $footer, $hasShadow, $isHeaderTransparent, $reverseHeader, $footerClass, $isOnRight;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $header = null, $hasShadow = true, $isHeaderTransparent = false, $footer = null, $reverseHeader = false, $footerClass = null, $isOnRight = true)
    {
        $this->title = $title;
        $this->header = $header;
        $this->hasShadow = $hasShadow || true;
        $this->isHeaderTransparent = $isHeaderTransparent;
        $this->footer = $footer;
        $this->reverseHeader = $reverseHeader;
        $this->footerClass = $footerClass;
        $this->isOnRight = $isOnRight;
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
