<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarBtnToggle extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $indexRoute, $createRoute, $icon, $active;
    public function __construct($title, $indexRoute, $createRoute, $icon, $active = '')
    {
        $this->title = $title;
        $this->indexRoute = $indexRoute;
        $this->createRoute = $createRoute;
        $this->icon = $icon;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-btn-toggle');
    }
}
