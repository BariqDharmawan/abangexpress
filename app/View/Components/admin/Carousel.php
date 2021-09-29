<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $carouselName, $isIndicatorHidden, $contents, $fieldImg;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $carouselName, $isIndicatorHidden = false, $contents, $fieldImg
    )
    {
        $this->carouselName = $carouselName;
        $this->isIndicatorHidden = $isIndicatorHidden;
        $this->contents = $contents;
        $this->fieldImg = $fieldImg;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.carousel');
    }
}
