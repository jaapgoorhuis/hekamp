<?php

namespace App\Livewire\Auth\Categories\SubCategories\Products;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageContent;
use App\Models\PageText;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $id;
    public $categoryId;
    public $subcategoryid;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        $this->categoryId = Route::current()->parameter('categoryid');
        $this->subcategoryid = Route::current()->parameter('subcategoryid');
        return view('livewire.auth.categories.subcategories.products.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/categories/'.$this->categoryId.'/subcategories/'.$this->subcategoryid.'/products', navigate: true);
    }

    public function remove()
    {
        $product = Product::find($this->id);

        foreach($product->getMedia('files') as $media) {
            $media->delete();
        }
        $product->delete();

        session()->flash('success',"Het product is verwijderd");

        return $this->redirect('/auth/categories/'.$this->categoryId.'/subcategories/'.$this->subcategoryid.'/products', navigate: true);
    }
}
