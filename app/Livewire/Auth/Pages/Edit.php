<?php

namespace App\Livewire\Auth\Pages;

use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public $page;
    public $id;
    public $title;
    public $route;
    public $page_type;
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $meta_robots;
    public $is_removable;
    public $is_active;
    public $header_image;
    public $show_header;
    public $show_footer;
    public $header_text;
    public $fileUploaded = false;

    use WithFileUploads;

    protected $rules = [
        'title' => 'required',
        'route' => 'required',
        'meta_description' => 'max:155'
    ];


    public function mount() {
        $this->id = Route::current()->parameter('id');
        $this->page = Page::where('id', $this->id)->first();
        $this->title = $this->page->title;
        $this->route = $this->page->route;
        $this->page_type = $this->page->page_type;
        $this->meta_title = $this->page->meta_title;
        $this->meta_description = $this->page->meta_description;
        $this->meta_keywords = $this->page->meta_keywords;
        $this->meta_robots = $this->page->meta_robots;
        $this->is_removable = $this->page->is_removable;
        $this->is_active = $this->page->is_active;
        $this->header_text = $this->page->header_text;
        $this->header_image = $this->page->header_image;
        $this->show_footer = $this->page->show_footer;
        $this->show_header = $this->page->show_header;
    }

    public function render()
    {
        return view('livewire.auth.pages.edit');
    }

    public function editPage() {
        $this->validate();


        if($this->header_image) {
            if(is_string($this->header_image)) {
                $headerimage = $this->header_image;
            }
            else {

                $headerimage = $this->header_image->getClientOriginalName();

                $this->header_image->storeAs('/public/images/frontend/uploads', $headerimage);
            }
        } else {
            $headerimage = '';
        }


        Page::whereId($this->id)->update([
            'title' => $this->title,
            'route' => $this->route,
            'page_type' => $this->page_type,
            'meta_title' => $this->title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_robots' => '',
            'is_removable' => $this->is_removable,
            'is_active' => $this->is_active,
            'header_image' => $headerimage,
            'show_footer' => $this->show_footer,
            'show_header'=> $this->show_header,
            'header_text' => $this->header_text
        ]);

        session()->flash('success','Pagina geupdate');

        return $this->redirect('/auth/pages', navigate: true);
    }
    public function cancelPage() {
        return $this->redirect('/auth/pages', navigate: true);
    }

    public function removeHeaderImage () {

        if(Storage::exists('/public/images/frontend/uploads/'.$this->header_image)) {
            Storage::delete('/public/images/frontend/uploads/'.$this->header_image);
        }

        $this->page->update([
            'header_image' => ''
        ]);

        $this->header_image = '';
    }
}
