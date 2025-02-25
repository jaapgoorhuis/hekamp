<?php

namespace App\Livewire\Auth\Categories\SubCategories;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageContent;
use App\Models\PageText;
use App\Models\Product;
use App\Models\SubCategorie;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $headCategoryId;
    public $id;

    public function render()
    {
        $this->headCategoryId = Route::current()->parameter('id');
        $this->id = Route::current()->parameter('slug');

        return view('livewire.auth.categories.subcategories.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/categories/'.$this->headCategoryId.'/subcategories', navigate: true);
    }

    public function remove()
    {
        SubCategorie::find($this->id)->delete();
        Product::where('subCategory_id', $this->id)->delete();

        session()->flash('success',"De subcategorie en onderliggende producten zijn verwijderd");

        return $this->redirect('/auth/categories/'.$this->headCategoryId.'/subcategories', navigate: true);
    }
}
