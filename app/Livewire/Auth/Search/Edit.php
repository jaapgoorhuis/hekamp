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
use Cassandra\Custom;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Edit extends Component
{

    public $keyword_nl;
    public $keyword_de;
    public $keyword_en;
    public $product_id;
    public $products;
    public $id;
    public $searchItem;


    public function rules()
    {
        return [
            'keyword_nl' => 'required|min:2',
        ];
    }
    public function mount() {
        $this->products = Product::get();

        $this->id = Route::current()->parameter('id');
        $this->searchItem = CustomSearch::find($this->id);
        $this->keyword_nl =  $this->searchItem->keyword_nl;
        $this->keyword_de =  $this->searchItem->keyword_de;
        $this->keyword_en =  $this->searchItem->keyword_en;
        $this->product_id =  $this->searchItem->product_id;

    }

    public function render()
    {
        return view('livewire.auth.search.edit');
    }

    public function update() {
        $this->validate();

        CustomSearch::find($this->id)->update([
            'keyword_nl' => $this->keyword_nl,
            'keyword_de' => $this->keyword_de,
            'keyword_en' => $this->keyword_en,
            'product_id' => $this->product_id,
        ]);

        session()->flash('success','De aanpassingen zijn opgeslagen');
        return $this->redirect('/auth/search', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/search', navigate: true);
    }
}
