<?php

namespace App\View\Components;

use App\Models\Admin\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    public $title;
    public $cats;
    /**
     * Create a new component instance.
     */
    public function __construct($title = null)
    {
        $this->title = $title ?? config('app.name');
        $this->cats = Category::where('parent_id', null)->with('children:id,name,slug')->get(['id', 'name', 'slug']);;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.front-layout');
    }
}
