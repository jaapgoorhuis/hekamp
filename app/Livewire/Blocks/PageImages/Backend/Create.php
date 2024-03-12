<?php

namespace App\Livewire\Blocks\PageImages\Backend;

use App\Models\PageBlock;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Create extends Component
{
    use WithFileUploads;

    public $id;
    public $test;
    public $image_url;
    public $image_url2;
    public $pageBlock;
    public $template_option;
    public $showTemplateOption1;
    public $showTemplateOption2;

    public function mount() {
        $this->id = Route::current()->parameter('id');
    }

    protected $rules = [
        'image_url' => 'required'
    ];

    public function render()
    {
        $this->pageBlock = PageBlock::where('id', $this->id)->first();

        return view('livewire.blocks.pageimages.Backend.create');
    }

    public function updateTemplate($var) {
        $this->template_option = $var;
        if($var == '1') {
            $this->showTemplateOption1 = true;
            $this->showTemplateOption2 = false;
        }
        else {
            $this->showTemplateOption1 = false;
            $this->showTemplateOption2 = true;
        }
    }

    public function storeBlock() {

        $this->validate();

        if($this->template_option == '2') {
            $validated = $this->validate([
                'image_url2' => 'required',
            ]);
            $image2 = $this->image_url2->getClientOriginalName();
            $this->image_url2->storeAs('/public/images/uploads', $this->image_url->getClientOriginalName());
        }
        else {
            $image2 = '';
        }

        DB::table('image_block')->insert(
            [
                'image_url' => $this->image_url->getClientOriginalName(),
                'image_url2' => $image2,
                'template_option' => $this->template_option,
            ]);

        $this->image_url->storeAs('/public/images/uploads', $this->image_url->getClientOriginalName());


        $latestBlock = DB::table('image_block')->orderBy('id', 'desc')->first();

        PageBlock::find($this->pageBlock->id)->update(['block_value_id' => $latestBlock->id]);

        session()->flash('success','Blok toegevoegd aan de pagina');
        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }

    public function cancel() {
       PageBlock::find($this->id)->delete();

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }
}
