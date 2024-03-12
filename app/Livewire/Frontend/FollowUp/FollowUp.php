<?php

namespace App\Livewire\Frontend\FollowUp;

use App\Models\Block;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class FollowUp extends Component
{
    public $route;
    public $firstPageBlock;
    public $secondPageBlock;
    public $pageBlocks;
    public $blockName;
    public $blockName2;

    public function render()
    {
        $this->route = Route::current()->parameter('locale');
        $this->page = Page::where('route', $this->route)->first();

        $orderIdFirstPageBlock = PageBlock::where('page_id', $this->page->id)->min('order_id');
        $this->pageBlocks = PageBlock::where('page_id', $this->page->id)->where('order_id', '>=', $orderIdFirstPageBlock+2)->orderBy('order_id')->get();
        $this->firstPageBlock = PageBlock::where('page_id', $this->page->id)->where('order_id', $orderIdFirstPageBlock)->first();

        $this->secondPageBlock = PageBlock::where('page_id', $this->page->id)->where('order_id', $orderIdFirstPageBlock +1)->first();

        if($this->firstPageBlock) {
            $this->blockName = Block::where('id', $this->firstPageBlock->block_id)->get();
        }
        else {
            $this->blockName = '';
        }

        if($this->secondPageBlock) {
            $this->blockName2 = Block::where('id', $this->secondPageBlock->block_id)->get();
        }
        else {
            $this->blockName2 = '';
        }

        return view('livewire.frontend.followUp.followUp');
    }
}
