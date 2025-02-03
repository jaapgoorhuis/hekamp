<?php

namespace App\Livewire\Frontend\Search;

use App\Models\CustomSearch;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Product;
use App\Models\Project;
use App\Models\SubCategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Search extends Component
{

    public $searchResult;
    public $customSearchResult;
    public $productIds = [];
    public $foundedProducts;

    public function render(Request $request)
    {
        $search = $request->input('search');

        $locale = App::getLocale();
        $titleVar = 'title_' . $locale;
        $keywordVar = 'keyword_' . $locale;

        $this->searchResult = Product::where($titleVar, 'like', "%$search%")->get();

        foreach($this->searchResult as $searchResult) {
            array_push($this->productIds, $searchResult->id);
        }
        $this->customSearchResult = CustomSearch::where($keywordVar, 'like', "%$search%")->get();

        foreach($this->customSearchResult as $customResult) {
            array_push($this->productIds, $customResult->product_id);
        }

        $this->foundedProducts = Product::whereIn('id', $this->productIds)->get();

        return view('livewire.frontend.search.search');
    }
}
