<?php

namespace App\Livewire\Auth\Categories\SubCategories\Products;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\SubCategorie;
use Livewire\Component;
use Livewire\WithFileUploads;

class Products extends Component
{
    public $subCategory;
    public $id;
    public $headCategory;
    public $products;
    public $slug;


    use WithFileUploads;


    public function render()
    {
        $this->products = Product::where('subCategory_id',$this->slug)->orderBy('order_id')->get();
        $this->headCategory = Categorie::where('id',$this->id)->first();
        $this->subCategory = SubCategorie::where('id', $this->slug)->first();

        return view('livewire.auth.categories.subcategories.products.products');
    }

    public function create() {

        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/'.$this->slug.'/products/create', navigate: true);
    }

    public function products($subCategory_id) {


        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/'.$subCategory_id.'/products', navigate: true);
    }

    public function edit($product_id) {
        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/'.$this->slug.'/products/edit/'.$product_id, navigate: true);
    }


    public function delete($product_id) {

        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/'.$this->slug.'/products/delete/'.$product_id, navigate: true);
    }

    public function updateProductOrder($list) {

        foreach($list as $item) {
            Product::where('id', $item['value'])->update(['order_id' => $item['order']]);
        }

    }
}
