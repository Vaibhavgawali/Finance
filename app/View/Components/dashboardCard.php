<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dashboardCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $bgClass;
    public $url;
    public $imageUrl;
    public $title;
    public $totalCountLabel;
    public $totalCount;
    public $icon;


    public function __construct($bgClass,$url,$imageUrl, $title, $totalCountLabel, $totalCount,$icon)
    {
        $this->bgClass = $bgClass;
        $this->icon = $icon;

        $this->url = $url;
        $this->imageUrl = $imageUrl;
        $this->title = $title;
        $this->totalCountLabel = $totalCountLabel;
        $this->totalCount = $totalCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
