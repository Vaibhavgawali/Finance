<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class retailer_dashboard_card extends Component
{
    /**
     * Create a new component instance.
     */
    public $bgClass;
    public $title;
    public $icon;
    public $btnbg;
    public $url;
    public function __construct($bgClass,$title,$icon,$btnbg,$url)
    {
        //
        $this->bgClass = $bgClass;
        $this->title = $title;
        $this->icon = $icon;
        $this->btnbg = $btnbg;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('components.retailer-dashboard-card');
    }
}
