<?php

namespace App\Livewire\Auth\Pages\Blocks;

use App\Models\Block;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Blocks extends Component
{

    public $id;
    public $pageBlocks;
    public $page;
    public $block;

    public function render()
    {
        $this->page = Page::whereId($this->id)->first();
        $this->pageBlocks = PageBlock::where('page_id', $this->id)->orderBy('order_id', 'asc')->get();

        return view('livewire.auth.pages.blocks.blocks', ['blocks' => $this->pageBlocks]);
    }

    public function choosePageBlock() {
        return $this->redirect('/auth/pages/blocks/'.$this->id.'/block-type', navigate: true);
    }

    public function editPageBlock($id) {
        $selectedPageBlock = PageBlock::where('id', $id)->first();
        $this->block = Block::where('id', $selectedPageBlock->block_id)->first();


        return $this->redirect('/auth/pages/blocks/'.$this->block->table_name.'/'.$id.'/edit', navigate: true);
    }

    public function deletePageBlock($id) {
        return $this->redirect('/auth/pages/blocks/delete/'.$id, navigate: true);
    }



    public function updateOrder($list) {

        foreach($list as $item) {
            PageBlock::find($item['value'])->update(['order_id' => $item['order']]);
        }
        return view('livewire.auth.pages.blocks.blocks');
    }

    public function showMessage() {
        $message = "This is a custom message from Livewire.";
        return view('livewire.auth.pages.blocks.message', ['message' => $message]);
    }
}
