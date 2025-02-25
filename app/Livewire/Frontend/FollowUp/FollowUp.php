<?php

namespace App\Livewire\Frontend\FollowUp;

use App\Models\Block;
use App\Models\Categorie;
use App\Models\ImageBlock;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class FollowUp extends Component
{
    public $categories;
    public $subcategories;
    public $page;
    public $route;
    public $projects;
    public $block_text_nl;
    public $block_text_de;
    public $block_text_en;
    public $locale;
    public $pageBlocks;
    public $authUser;
    public $id;
    public $showEditBox = false;


    public function mount() {
        $this->route = Route::current()->parameter('slug');
        $this->page = Page::where('route', $this->route)->first();

        $this->pageBlocks = PageBlock::where('page_id',$this->page->id)->get();
    }

    public function render()
    {
        $this->locale = App::getLocale();
        $this->categories = Categorie::orderBy('order_id', 'asc')->get();
        $this->subcategories = \App\Models\SubCategorie::where('show_home', '1')->orderBy('order_id', 'asc')->get();
        $this->authUser = User::find(Auth::id());


        if(count($this->pageBlocks)) {

            $this->pageBlocks = PageBlock::where('page_id', $this->page->id)->orderBy('order_id')->get();
        } else {
            $this->pageBlocks = [];
        }

        return view('livewire.frontend.followUp.followUp');
    }

    public function editBlockText($id) {


        if($this->authUser) {

            if($this->showEditBox) {
                $this->showEditBox = false;
            }
            else {
                $this->showEditBox = true;
            }

            $this->pageBlockId = $id;

            $textblock = \App\Models\TextBlock::where('id', $id)->first();

            if ($textblock) {
                $this->block_text_nl = $textblock->value_nl;
                $this->block_text_de = $textblock->value_de;
                $this->block_text_en = $textblock->value_en;
            } else {
                $this->block_text_nl = '';
                $this->block_text_en = '';
                $this->block_text_de = '';
            }
        }
    }

    #[On('updateBlokText')]
    public function updateBlokText($id) {

        if($this->authUser) {
            $textblock = \App\Models\TextBlock::find($id);

            if ($textblock) {

                $textblock->update([
                    'value_nl' => $this->block_text_nl,
                    'value_de' => $this->block_text_de,
                    'value_en' => $this->block_text_en,
                ]);
            } else {
                \App\Models\TextBlock::create([
                    'value_nl' => $this->block_text_nl,
                    'value_de' => $this->block_text_de,
                    'value_en' => $this->block_text_en,
                ]);
            }
            $this->showEditBox = false;
            $this->dispatch('refresh-the-component');
        }

        return view('livewire.frontend.index.home');
    }

    public function editBlockImage($id) {
        if($this->authUser) {
            if($this->showImageEditBox) {
                $this->showImageEditBox = false;
            }
            else {
                $this->showImageEditBox = true;
            }
            $pageBlock = PageBlock::find($id);

            $this->imageBlock = ImageBlock::where('id', $pageBlock->block_value_id)->first();
            $this->files = $this->imageBlock->getMedia('image_block');
        }
    }

    #[On('uploadFiles')]
    public function uploadFiles() {
        if($this->authUser) {
            $mediaItems = $this->imageBlock->getMedia('image_block');
            foreach ($mediaItems as $item) {
                $item->delete();
            }

            if (Storage::disk('tmp')->exists($this->files->getFileName())) {
                $this->imageBlock->addMedia($this->files->getRealPath())->toMediaCollection('image_block');
            }
            $this->dispatch('updated');
            $this->showImageEditBox = false;
        }
    }

}
