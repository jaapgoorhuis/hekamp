<?php

namespace App\Livewire\Frontend\Subcategories;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Project;
use App\Models\SubCategorie;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Subcategories extends Component
{
    public $subcategories;
    public $currentCategory;
    public $route;
    public $slug;

    public function render()
    {
        $this->route = Route::current()->parameter('route');
        $this->slug = Route::current()->parameter('slug');
        $this->subcategories = SubCategorie::get();
        $this->currentCategory = SubCategorie::where('route', $this->route)->first();
        return view('livewire.frontend.subcategories.subcategories');
    }
}
