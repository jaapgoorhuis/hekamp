<?php

namespace App\Livewire\Auth\Categories;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\SubCategorie;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $id;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        return view('livewire.auth.categories.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/categories', navigate: true);
    }

    public function remove()
    {
        Categorie::find($this->id)->delete();


        $subcategories = SubCategorie::where('category_id', $this->id)->get();

        foreach($subcategories as $categories) {
            Product::where('subCategory_id',$categories->id)->delete();
        }

        SubCategorie::where('category_id', $this->id)->delete();


        session()->flash('success',"De categorie is verwijderd");

        return $this->redirect('/auth/categories', navigate: true);
    }
}
