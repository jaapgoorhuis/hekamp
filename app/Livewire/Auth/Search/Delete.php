<?php

namespace App\Livewire\Auth\Search;

use App\Models\CustomSearch;
use App\Models\MenuItems;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $id;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        return view('livewire.auth.search.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/search', navigate: true);
    }

    public function remove()
    {
        CustomSearch::find($this->id)->delete();

        session()->flash('success',"Het zoekwoord is verwijderd");

        return $this->redirect('/auth/search', navigate: true);
    }
}
