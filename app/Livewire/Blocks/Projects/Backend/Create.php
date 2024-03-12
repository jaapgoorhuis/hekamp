<?php

namespace App\Livewire\Blocks\Projects\Backend;

use App\Models\PageBlock;
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

    public $id;
    public $pageBlock;

    use WithFileUploads;

    public function mount() {
        $this->id = Route::current()->parameter('id');
    }

    public function render()
    {
        $this->pageBlock = PageBlock::where('id', $this->id)->first();
        return view('livewire.blocks.projects.backend.create');
    }

   public function storeBlock() {
       session()->flash('success','Blok toegevoegd aan de pagina');
       return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
   }

    public function cancel() {
        PageBlock::find($this->id)->delete();

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }
}
