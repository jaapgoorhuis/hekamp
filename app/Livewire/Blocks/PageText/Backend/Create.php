<?php

namespace App\Livewire\Blocks\PageText\Backend;

use App\Models\PageBlock;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use mysql_xdevapi\Schema;

class Create extends Component
{
    public $id;
    public $test;
    public $value;
    public $pageBlock;

    public function mount() {
        $this->id = Route::current()->parameter('id');
    }

    public function render()
    {
        $this->pageBlock = PageBlock::where('id', $this->id)->first();

        return view('livewire.blocks.pagetext.Backend.create');
    }

    public function storeBlock() {

        DB::table('text_block')->insert(['value' => $this->value]);

        $latestBlock = DB::table('text_block')->orderBy('id', 'desc')->first();

        PageBlock::find($this->pageBlock->id)->update(['block_value_id' => $latestBlock->id]);

        session()->flash('success','Blok toegevoegd aan de pagina');
        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }

    public function cancel() {
       PageBlock::find($this->id)->delete();

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }
}
