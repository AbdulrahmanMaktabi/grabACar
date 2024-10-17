<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBarBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public $route, $title, $active;
    public function __construct($route, $title, $active = '')
    {
        $this->title = $title;
        $this->route = $route;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-btn');
    }
}
