<?php

namespace App\Livewire\Frontend\Index;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Index extends Component
{
    public $pageBlocks;
    public $page;
    public $route;
    public $projects;

    public function render()
    {
        $this->route = Route::current()->parameter('locale');
        $this->projects = Project::orderBy('order_id')->get();
        if(!$this->route) {
            $this->route = 'index';
        }

        $this->page = Page::where('route', $this->route)->first();
        $this->pageBlocks = PageBlock::where('page_id', $this->page->id)->orderBy('order_id')->get();

        return view('livewire.frontend.index.home');
    }
}
