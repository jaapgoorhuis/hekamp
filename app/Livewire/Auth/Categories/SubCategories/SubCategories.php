<?php

namespace App\Livewire\Auth\Categories\SubCategories;

use App\Models\Categorie;
use App\Models\SubCategorie;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubCategories extends Component
{
    public $subcategories;
    public $id;
    public $headCategory;

    use WithFileUploads;


    public function render()
    {
        $this->headCategory = Categorie::where('id',$this->id)->first();
        $this->subcategories = SubCategorie::where('category_id', $this->id)->orderBy('order_id', 'asc')->get();


        return view('livewire.auth.categories.subcategories.subcategories');
    }

    public function create() {
        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/create', navigate: true);
    }

    public function products($subCategory_id) {


        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/'.$subCategory_id.'/products', navigate: true);
    }

    public function edit($subCategory_id) {
        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/edit/'.$subCategory_id, navigate: true);
    }


    public function delete($subCategory_id) {

        return $this->redirect('/auth/categories/'.$this->id.'/subcategories/delete/'.$subCategory_id, navigate: true);
    }

    public function updateOrder($list) {

        foreach($list as $item) {
            SubCategorie::where('id', $item['value'])->update(['order_id' => $item['order']]);
        }

    }
}
