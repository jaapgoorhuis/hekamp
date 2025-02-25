<?php

namespace App\Livewire\Auth\Categories;

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

    public $title_en;
    public $route;
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
    public $categorie_text_nl;
    public $categorie_text_de;
    public $categorie_text_en;
    public $icon;


    use WithFilePond;
    use WithFileUploads;

    protected $rules = [
        'title_nl' => 'required:unique',
    ];

    public function render()
    {

        return view('livewire.auth.categories.create');
    }

    public function store() {

        $this->validate();



        $string = str_replace(' ', '', $this->title_nl);
        $string = str_replace(['/','|','&'], '-' ,$string);

        $this->route = strtolower($string);

        Categorie::create([
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



        $this->uploadFiles();

        session()->flash('success','Categorie toegevoegd');

        return $this->redirect('/auth/categories', navigate: true);
    }

    public function cancel() {
        return $this->redirect('/auth/categories', navigate: true);
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }

    public function uploadFiles() {

        if($this->icon) {
            $category = Categorie::orderBy('id', 'desc')->first();
            if (Storage::disk('tmp')->exists($this->icon->getFileName())) {
                $category->addMedia($this->icon->getRealPath())->withCustomProperties(['extension' => $this->icon->getClientOriginalExtension()])->toMediaCollection('icon');
            }

            $uploadedFiles = Media::where('model_id', $category->id)->get();
            foreach ($uploadedFiles as $media) {
                if ($media->friendly_name == '') {
                    Media::where('id', $media->id)->update([
                        'friendly_name' => $media->name,
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
