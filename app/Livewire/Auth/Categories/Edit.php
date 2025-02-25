<?php

namespace App\Livewire\Auth\Categories;

use App\Models\Categorie;
use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    public $id;
    public $route;
    public $categorie;
    public $title_en;
    public $title_nl;
    public $title_de;
    public $meta_title_nl;
    public $meta_title_de;
    public $meta_title_en;
    public $meta_description_nl;
    public $meta_description_de;
    public $meta_description_en;
    public $meta_keywords_en;
    public $meta_keywords_de;
    public $meta_keywords_nl;
    public $meta_robots;
    public $is_removable = '1';
    public $is_active = '1';
    public $show_header = '1';
    public $show_footer = '1';
    public $categorie_text_nl;
    public $categorie_text_de;
    public $categorie_text_en;
    public $mediaItems;
    public $icon;
    public $newIcon;

    use WithFileUploads;

    use WithFilePond;

    public function mount() {
        $this->categorie = Categorie::find($this->id);
        $this->mediaItems = $this->categorie->getMedia('icon');
        $this->title_nl = $this->categorie->title_nl;
        $this->route = $this->categorie->route;
        $this->title_de = $this->categorie->title_de;
        $this->title_en = $this->categorie->title_en;
        $this->meta_title_nl = $this->categorie->meta_title_nl;
        $this->meta_title_de = $this->categorie->meta_title_de;
        $this->meta_title_en = $this->categorie->meta_title_en;
        $this->meta_description_nl = $this->categorie->meta_description_nl;
        $this->meta_description_de = $this->categorie->meta_description_de;
        $this->meta_description_en = $this->categorie->meta_description_en;
        $this->meta_keywords_nl = $this->categorie->meta_keywords_nl;
        $this->meta_keywords_de = $this->categorie->meta_keywords_de;
        $this->meta_keywords_en = $this->categorie->meta_keywords_en;
        $this->is_removable = $this->categorie->is_removable;
        $this->is_active = $this->categorie->is_active;
        $this->categorie_text_nl = $this->categorie->categorie_text_nl;
        $this->categorie_text_de = $this->categorie->categorie_text_de;
        $this->categorie_text_en = $this->categorie->categorie_text_en;
    }


    public function render()
    {

        $this->icon = $this->categorie->getMedia('icon');
        return view('livewire.auth.categories.edit');
    }

    public function rules()
    {
        return [
            'title_nl' => 'required|unique:categories,title_nl,'.$this->id,
            'meta_description_nl' => 'max:155',
            'route' => 'required|unique:categories,route,'.$this->id,
            'meta_description_de' => 'max:155',
            'meta_description_en' => 'max:155',
        ];
    }


    public function edit() {
        $this->validate($this->rules());

        Categorie::whereId($this->id)->update([
            'route' => $this->route,
            'title_nl' => $this->title_nl,
            'title_de' => $this->title_de,
            'title_en' => $this->title_en,
            'meta_title_en' => $this->meta_title_en,
            'meta_title_de' => $this->meta_title_de,
            'meta_title_nl' => $this->meta_title_nl,
            'meta_description_en' => $this->meta_description_en,
            'meta_description_de' => $this->meta_description_de,
            'meta_description_nl' => $this->meta_description_nl,
            'meta_keywords_en' => $this->meta_keywords_en,
            'meta_keywords_de' => $this->meta_keywords_de,
            'meta_keywords_nl' => $this->meta_keywords_nl,
            'meta_robots' => '',
            'is_removable' => $this->is_removable,
            'is_vissible' => '1',
            'is_active' => $this->is_active,
            'categorie_text_nl' => $this->categorie_text_nl,
            'categorie_text_de' => $this->categorie_text_de,
            'categorie_text_en' => $this->categorie_text_en,
        ]);

        session()->flash('success','Categorie bewerkt');

        return $this->redirect('/auth/categories', navigate: true);
    }
    public function cancel() {
        return $this->redirect('/auth/categories', navigate: true);
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function removeExistingFiles($id) {

        foreach($this->mediaItems as $mediaitem) {
            if($mediaitem->id == $id) {
                $mediaitem->delete();
            }
        }
        $this->dispatch('pondReset');
    }

    #[On('uploadFiles')]
    public function uploadFiles() {

        $existingMedia = $this->categorie->getMedia('icon');

        foreach($existingMedia as $media) {
            $media->delete();
        }

        $this->categorie->addMedia($this->newIcon->getRealPath())->toMediaCollection('icon');

        $uploadedFiles = Media::where('model_id', $this->id)->get();
        foreach($uploadedFiles as $media) {
            if($media->friendly_name == '') {
                Media::where('id', $media->id)->update([
                    'friendly_name' => $media->name,
                ]);
            }

        }
        $this->dispatch('updated');

    }

    public function updateFileName($value, $value2) {
        $this->mediaId = $value;
        Media::where('id', $this->mediaId)->update(['friendly_name' => $value2]);
    }
}
