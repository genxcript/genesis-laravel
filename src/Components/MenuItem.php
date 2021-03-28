<?php

namespace LaravelGenesis\Genesis\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $href = '#';
    public $active = false;
    public $icon = false;

    public function __construct($href, $active, $icon)
    {
        $this->href = $href;
        $this->active = $active;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('genesis::components.menu-item');
    }
}
