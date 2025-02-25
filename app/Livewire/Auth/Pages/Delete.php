<?php

namespace App\Livewire\Auth\Pages;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageContent;
use App\Models\PageText;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $id;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        return view('livewire.auth.pages.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/pages', navigate: true);
    }

    public function remove()
    {
        $page = Page::find($this->id);

        $media = $page->getMedia('files');
        foreach($media as $item) {
            $item->delete();
        }

        $page->delete();

        PageBlock::where('page_id', $this->id)->delete();



        session()->flash('success',"De pagina is verwijderd");

        return $this->redirect('/auth/pages', navigate: true);
    }
}
