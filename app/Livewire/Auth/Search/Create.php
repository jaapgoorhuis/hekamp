<?php

namespace App\Livewire\Auth\Search;

use App\Models\CustomSearch;
use App\Models\MenuItems;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Create extends Component
{

    public $keyword_nl;
    public $keyword_de;
    public $keyword_en;
    public $product_id;
    public $products;

    use WithFileUploads;

    public function mount() {
        $this->products = Product::get();
    }

    public function rules()
    {
        return [
            'keyword_nl' => 'required|min:2',
        ];
    }

    public function render()
    {
        return view('livewire.auth.search.create');
    }

    public function store() {
        $this->validate();

        if(!$this->product_id) {
            $this->product_id = Product::orderBy('created_at', 'asc')->first()->id;
        }

        CustomSearch::create([
            'keyword_nl' => $this->keyword_nl,
            'keyword_de' => $this->keyword_de,
            'keyword_en' => $this->keyword_en,
            'product_id' => $this->product_id,
        ]);

        session()->flash('success','Het zoekwoord is toegevoegd');
        return $this->redirect('/auth/search', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/search', navigate: true);
    }
}
