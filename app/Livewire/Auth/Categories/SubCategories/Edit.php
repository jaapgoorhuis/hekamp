<?php

namespace App\Livewire\Auth\Categories\SubCategories;

use App\Models\Categorie;
use App\Models\Page;
use App\Models\SubCategorie;
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
    public $subCategory;
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
    public $newTumbnail;
    public $tumbnail;
    public $show_header = '1';
    public $show_footer = '1';
    public $subcategorie_text_nl;
    public $subcategorie_text_de;
    public $subcategorie_text_en;
    public $headCategoryId;
    public $mediaItems;
    public $show_home;

    use WithFileUploads;
    use WithFilePond;

    public function mount() {
        $this->headCategoryId =  Route::current()->parameter('id');
        $this->id = Route::current()->parameter('slug');
        $this->subCategory = SubCategorie::where('id', $this->id)->first();

        $this->mediaItems = $this->subCategory->getMedia('tumbnail');

        $this->route = $this->subCategory->route;
        $this->title_nl = $this->subCategory->title_nl;
        $this->show_home = $this->subCategory->show_home;
        $this->title_de = $this->subCategory->title_de;
        $this->title_en = $this->subCategory->title_en;
        $this->meta_title_nl = $this->subCategory->meta_title_nl;
        $this->meta_title_de = $this->subCategory->meta_title_de;
        $this->meta_title_en = $this->subCategory->meta_title_en;
        $this->meta_description_nl = $this->subCategory->meta_description_nl;
        $this->meta_description_de = $this->subCategory->meta_description_de;
        $this->meta_description_en = $this->subCategory->meta_description_en;
        $this->meta_keywords_nl = $this->subCategory->meta_keywords_nl;
        $this->meta_keywords_de = $this->subCategory->meta_keywords_de;
        $this->meta_keywords_en = $this->subCategory->meta_keywords_en;
        $this->is_removable = $this->subCategory->is_removable;
        $this->is_active = $this->subCategory->is_active;
        $this->subcategorie_text_nl = $this->subCategory->subCategory_text_nl;
        $this->subcategorie_text_de = $this->subCategory->subCategory_text_de;
        $this->subcategorie_text_en = $this->subCategory->subCategory_text_en;

    }

    public function render()
    {
        //when rendering images on upload this is important!!!
        $this->subCategory = SubCategorie::where('id',$this->id)->first();
        $this->tumbnail = $this->subCategory->getMedia('tumbnail');
        return view('livewire.auth.categories.subcategories.edit');
    }

    public function rules()
    {
        return [
            'title_nl' => 'required|unique:sub_categories,title_nl,'.$this->id,
            'route' => 'required|unique:sub_categories,route,'.$this->id,
            'meta_description_nl' => 'max:155',
            'meta_description_de' => 'max:155',
            'meta_description_en' => 'max:155',
        ];
    }



    public function edit() {
        $this->validate($this->rules());


        SubCategorie::whereId($this->id)->update([
                'category_id' => $this->headCategoryId,
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
                'show_home' => $this->show_home,
                'is_active' => $this->is_active,
                'subCategory_text_nl' => $this->subcategorie_text_nl,
                'subCategory_text_de' => $this->subcategorie_text_de,
                'subCategory_text_en' => $this->subcategorie_text_en,

            ]);

        session()->flash('success','Sub categorie bewerkt');

        return $this->redirect('/auth/categories/'.$this->headCategoryId.'/subcategories', navigate: true);
    }
    public function cancel() {
        return $this->redirect('/auth/categories/'.$this->headCategoryId.'/subcategories', navigate: true);
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
        $existingMedia = $this->subCategory->getMedia('tumbnail');

        foreach($existingMedia as $media) {
            $media->delete();
        }

        $this->subCategory->addMedia($this->newTumbnail->getRealPath())->withCustomProperties(['name' => $this->newTumbnail->getClientOriginalName()])->toMediaCollection('tumbnail');

        $uploadedFiles = Media::where('model_id', $this->id)->get();
        foreach($uploadedFiles as $media) {
            if($media->friendly_name == '') {
                Media::where('id', $media->id)->update([
                    'friendly_name' => $media->getCustomProperty('name'),
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
