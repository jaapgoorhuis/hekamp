<?php

namespace App\Livewire\Blocks\PageText\Backend;

use App\Models\PageBlock;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use mysql_xdevapi\Schema;

class Edit extends Component
{
    public $id;
    public $test;
    public $value;
    public $existingValue;
    public $pageBlock;
    public $currentBlock;

    public function mount() {
        $this->id = Route::current()->parameter('id');
    }

    public function render()
    {
        $this->pageBlock = PageBlock::where('id', $this->id)->first();

        $this->currentBlock = DB::table('text_block')->where('id', $this->pageBlock->block_value_id)->first();

        $this->existingValue = $this->currentBlock->value;

        return view('livewire.blocks.pagetext.Backend.edit');
    }

    public function updateBlock() {
        if($this->value) {
            $value = $this->value;
        }
        else {
            $value = $this->currentBlock->value;
        }

        DB::table('text_block')->whereId($this->currentBlock->id)->update(['value' => $value]);

        session()->flash('success','Het blok is geupdate');
        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }

    public function cancel() {

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }
}
