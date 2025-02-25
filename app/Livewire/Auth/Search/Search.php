<?php

namespace App\Livewire\Auth\Search;

use App\Models\CustomSearch;
use App\Models\MenuItems;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Search extends Component
{
    public $search_items;


    use WithFileUploads;


    public function render()
    {
        $this->search_items = CustomSearch::get();
        return view('livewire.auth.search.search');
    }

    public function create() {
        return $this->redirect('/auth/search/create', navigate: true);
    }

    public function edit($id) {
        return $this->redirect('/auth/search/edit/'.$id, navigate: true);
    }




    public function delete($id) {

        return $this->redirect('/auth/search/delete/'.$id, navigate: true);
    }


}
