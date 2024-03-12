<?php

namespace App\Livewire\Frontend\Projects;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Projects extends Component
{
    public $projects;
    public $pageBlocks;
    public $route;
    public $page;

    public function render()
    {
        $this->route = Route::current()->parameter('locale');
        $this->page = Page::where('route', $this->route)->first();
        $this->pageBlocks = PageBlock::where('page_id', $this->page->id)->orderBy('order_id')->get();

        $this->projects = Project::orderBy('order_id', 'asc')->get();
        return view('livewire.frontend.projects.projects');
    }
}
