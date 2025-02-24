<?php

namespace App\Livewire\Auth\Categories\SubCategories;

use App\Models\Categorie;
use App\Models\Page;
use App\Models\SubCategorie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{

    public $id;
    public $route;
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
    public $header_image;
    public $show_header = '1';
    public $show_footer = '1';
    public $subcategorie_text_nl;
    public $subcategorie_text_de;
    public $subcategorie_text_en;
    public $category_id;
    public $show_home = '0';

    use WithFilePond;
    use WithFileUploads;

    protected $rules = [
        'title_nl' => 'required|unique:sub_categories',
    ];

    public function render()
    {
        return view('livewire.auth.categories.subcategories.create');
    }

    public function store() {
        $this->validate();

        $string = str_replace(' ', '', $this->title_nl);
        $string = str_replace(['/','|','&'], '-' ,$string);

        $this->route = strtolower($string);

        SubCategorie::create([
            'route' => $this->route,
            'category_id' => $this->id,
            'show_home' => $this->show_home,
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
            'subCategory_text_nl' => $this->subcategorie_text_nl,
            'subCategory_text_de' => $this->subcategorie_text_de,
            'subCategory_text_en' => $this->subcategorie_text_en,

        ]);


        $this->uploadFiles();

        session()->flash('success','Subcategorie toegevoegd');

        return $this->redirect('/auth/categories/'.$this->id.'/subcategories', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/categories/'.$this->id.'/subcategories', navigate: true);
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function uploadFiles() {

        if($this->header_image) {
            $subcategory = SubCategorie::orderBy('id', 'desc')->first();
            if (Storage::disk('tmp')->exists($this->header_image->getFileName())) {
                $subcategory->addMedia($this->header_image->getRealPath())->withCustomProperties(['name' => $this->header_image->getClientOriginalName()])->toMediaCollection('tumbnail');
            }

            $uploadedFiles = Media::where('model_id', $subcategory->id)->get();
            foreach ($uploadedFiles as $media) {
                if ($media->friendly_name == '') {
                    Media::where('id', $media->id)->update([
                        'friendly_name' => $media->getCustomProperty('name'),
                    ]);
                }
            }

            $this->dispatch('updated');
        }
    }

    public function updateFileName($value, $value2) {
        $this->mediaId = $value;
        Media::where('id', $this->mediaId)->update(['friendly_name' => $value2]);
    }


}
