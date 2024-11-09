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
    public $route, $title, $active, $icon;
    public function __construct($route, $title, $active = '', $icon = null)
    {
        $this->title = $title;
        $this->route = $route;
        $this->active = $active;
        $this->icon = $icon ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar-btn');
    }
}
