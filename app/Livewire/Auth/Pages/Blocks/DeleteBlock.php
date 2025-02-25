<?php

namespace App\Livewire\Auth\Pages\Blocks;

use App\Models\Block;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class DeleteBlock extends Component
{
    public $id;
    public $pageBlock;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        $this->pageBlock = PageBlock::find($this->id);

        return view('livewire.auth.pages.blocks.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }

    public function remove()
    {
        PageBlock::find($this->id)->delete();

        $blockname = Block::where('id', $this->pageBlock->block_id)->first();

        DB::table($blockname->table_name)->where('id', $this->pageBlock->block_value_id)->delete();


        session()->flash('success',"Het block is verwijderd");

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }
}
