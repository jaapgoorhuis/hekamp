<?php

namespace App\Livewire\Auth\Categories;

use App\Models\Categorie;
use Livewire\Component;
use Livewire\WithFileUploads;

class Categories extends Component
{
    public $categories;

    use WithFileUploads;


    public function render()
    {
        $this->categories = Categorie::orderBy('order_id', 'asc')->get();
        return view('livewire.auth.categories.categories');
    }

    public function create() {
        return $this->redirect('/auth/categories/create', navigate: true);
    }

    public function edit($id) {
        return $this->redirect('/auth/categories/edit/'.$id, navigate: true);
    }

    public function subCategories($id) {
        return $this->redirect('/auth/categories/'.$id.'/subcategories/', navigate: true);
    }

    public function delete($id) {

        return $this->redirect('/auth/categories/delete/'.$id, navigate: true);
    }

    public function updateOrder($list) {

        foreach($list as $item) {
            Categorie::where('id', $item['value'])->update(['order_id' => $item['order']]);
        }

    }
}
