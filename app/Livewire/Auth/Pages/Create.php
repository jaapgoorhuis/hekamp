<?php

namespace App\Livewire\Auth\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    public $pages;
    public $title;
    public $route;
    public $page_type = 'index';
    public $meta_title;
    public $meta_description;
    public $meta_keywords;
    public $meta_robots;
    public $is_removable = '1';
    public $is_active = '1';
    public $header_image;
    public $show_header = '1';
    public $show_footer = '1';
    public $header_text;

    use WithFileUploads;

    protected $rules = [
        'title' => 'required',
        'route' => 'required',
        'meta_description' => 'max:155'
    ];

    public function render()
    {

        return view('livewire.auth.pages.create');
    }

    public function storePage() {
        $this->validate();

        if($this->header_image) {
            $headerimage = $this->header_image->getClientOriginalName();
            $this->header_image->storeAs('/public/images/frontend/uploads', $headerimage);
        } else {
            $headerimage = '';
        }

        Page::create([
            'title' => $this->title,
            'route' => $this->route,
            'page_type' => $this->page_type,
            'meta_title' => $this->title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_robots' => '',
            'is_removable' => $this->is_removable,
            'is_vissible' => '1',
            'is_active' => $this->is_active,
            'header_image' => $headerimage,
            'show_footer' => $this->show_footer,
            'show_header'=> $this->show_header,
            'header_text' => $this->header_text
        ]);



        session()->flash('success','Pagina toegevoegd');

        return $this->redirect('/auth/pages', navigate: true);
    }

    public function cancelPage() {
        return $this->redirect('/auth/pages', navigate: true);
    }

    public function removeHeaderImage () {
        $this->tumbnail = '';
    }

}
