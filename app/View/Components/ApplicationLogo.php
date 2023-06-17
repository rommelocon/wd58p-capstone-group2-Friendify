<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ApplicationLogo extends Component
{
    public $width;
    public $height;
    public $color;

    public function __construct($width = null, $height = null, $color = null)
    {
        $this->width = $width;
        $this->height = $height;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.application-logo');
    }
}
