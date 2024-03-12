<?php

namespace App\Livewire\Auth\Pages\Blocks;

use App\Models\Block;
use App\Models\PageBlock;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ChooseBlock extends Component
{

    public $id;
    public $blocks;
    public $block_id = "1";
    public $name;
    public $pageBlock;

    protected $rules = [
        'name' => 'unique:page_blocks',
        'block_id' => 'required'
    ];

    public function render()
    {
        $this->blocks = Block::get();
        return view('livewire.auth.pages.blocks.chooseBlock', ['blocks' => $this->blocks]);
    }

    public function cancel() {
        return $this->redirect('/auth/pages/blocks/'.$this->id, navigate: true);
    }

    public function storePageBlockChoise() {
        $this->validate();

        $latestPageBlock = PageBlock::where('page_id', $this->id)->orderBy('order_id', 'desc')->first();

        if($latestPageBlock) {
            $order = $latestPageBlock->order_id +1;
        } else {
            $order = '1';
        }

        PageBlock::create([
            'page_id' => $this->id,
            'block_id' => $this->block_id,
            'block_value_id' => 0,
            'name' => $this->name,
            'order_id' => $order
        ]);

        $this->pageBlock = PageBlock::orderBy('created_at', 'desc')->first();

        $block = Block::where('id', $this->pageBlock->block_id)->first();

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->id.'/'.$block->table_name.'/create', navigate: true);
    }
}
