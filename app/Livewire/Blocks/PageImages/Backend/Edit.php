<?php

namespace App\Livewire\Blocks\PageImages\Backend;

use App\Models\PageBlock;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Edit extends Component
{
    public $id;
    public $test;
    public $image_url;
    public $image_url2;
    public $pageBlock;
    public $currentBlock;
    public $template_option;
    public $showTemplateOption1;
    public $showTemplateOption2;

    use WithFileUploads;

    public function mount() {
        $this->id = Route::current()->parameter('id');
        $this->pageBlock = PageBlock::where('id', $this->id)->first();

        $this->currentBlock = DB::table('image_block')->where('id', $this->pageBlock->block_value_id)->first();

        $this->image_url = $this->currentBlock->image_url;
        $this->image_url2 = $this->currentBlock->image_url2;
        $this->template_option = $this->currentBlock->template_option;

        $this->updateTemplate($this->template_option);
    }

    protected $rules = [
        'image_url' => 'required'
    ];

    public function render()
    {
        return view('livewire.blocks.pageimages.Backend.edit');
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

    public function updateBlock() {
        $this->validate();
        if($this->template_option == '2') {
            $validated = $this->validate([
                'image_url2' => 'required',
            ]);

            if(!is_string($this->image_url2)) {
                $imageurl2 = $this->image_url2->getClientOriginalName();
                $this->image_url2->storeAs('/public/images/uploads/'. $imageurl2);
            }
            else {
                $imageurl2 = $this->image_url2;
            }
        }
        else {
            $imageurl2 = '';
        }

        if(!is_string($this->image_url)) {
            $imageurl1 = $this->image_url->getClientOriginalName();
            $this->image_url->storeAs('/public/images/uploads/'. $imageurl1);
        }
        else {
            $imageurl1 = $this->image_url;
        }

        DB::table('image_block')->where('id', $this->pageBlock->block_value_id)->update(
            [
                'image_url' => $imageurl1,
                'image_url2' => $imageurl2,
                'template_option' => $this->template_option,
            ]);

        $latestBlock = DB::table('image_block')->orderBy('id', 'desc')->first();

        PageBlock::find($this->pageBlock->id)->update(['block_value_id' => $latestBlock->id]);

        session()->flash('success','Het blok is geupdate');
        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }

    public function cancel() {

        return $this->redirect('/auth/pages/blocks/'.$this->pageBlock->page_id, navigate: true);
    }

    public function removeImageUrl () {

        if(Storage::exists('/public/images/frontend/uploads/'.$this->image_url)) {
            Storage::delete('/public/images/frontend/uploads/'.$this->image_url);
        }

        DB::table('image_block')->where('id', $this->pageBlock->block_value_id)->update([
            'image_url' => ''
        ]);

        $this->image_url = '';
    }

    public function removeImageUrl2 () {

        if(Storage::exists('/public/images/frontend/uploads/'.$this->image_url2)) {
            Storage::delete('/public/images/frontend/uploads/'.$this->image_url2);
        }

        DB::table('image_block')->where('id', $this->pageBlock->block_value_id)->update([
            'image_url2' => ''
        ]);

        $this->image_url2 = '';
    }
}
