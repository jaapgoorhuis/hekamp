<?php

namespace App\Livewire\Auth\Categories\SubCategories\Products;

use App\Models\Categorie;
use App\Models\MenuItems;
use App\Models\Page;
use App\Models\Product;
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
use function Webmozart\Assert\Tests\StaticAnalysis\inArray;

class Edit extends Component
{

    public $headCategory_id;
    public $title_en;
    public $title_nl;
    public $title_de;
    public string $product_text_nl = '';
    public $product_text_de;
    public $product_text_en;
    public $subCategory_id;
    public $is_active = 1;
    public $is_active_home = 1;
    public $value;
    public $files = [];
    public $product;
    public $id;
    public $mediaItems;
    public $imageUrl;
    public $filename = '';
    public $images = [];
    public $videos = [];
    public $pdffiles = [];

    use WithFilePond;
    use WithFileUploads;

    public function mount($categoryid,$subcategoryid) {
        $this->headCategory_id = $categoryid;
        $this->subCategory_id = $subcategoryid;
        $this->product = Product::find($this->id);
        $this->title_nl = $this->product->title_nl;
        $this->title_de = $this->product->title_de;
        $this->title_en = $this->product->title_en;
        $this->is_active = $this->product->is_active;
        $this->is_active_home = $this->product->is_active_home;
        $this->product_text_nl = $this->product->product_text_nl;
        $this->product_text_de = $this->product->product_text_de;
        $this->product_text_en= $this->product->product_text_en;
        $this->mediaItems = $this->product->getMedia('files');
    }

    public function rules()
    {
        return [
            'title_nl' => 'required|unique:products,title_nl,'.$this->id,
        ];
    }

    public function render()
    {
        $this->product = Product::where('id',$this->id)->first();

        $this->images = Media::where('model_type', 'App\Models\Product')->where('mime_type','LIKE', '%image/%')->where('model_id', $this->id)->orderBy('order_column')->get();

        $this->pdffiles = Media::where('model_type', 'App\Models\Product')->where('mime_type','LIKE', '%application/%')->where('model_id', $this->id)->orderBy('order_column')->get();

        $this->videos = Media::where('model_type', 'App\Models\Product')->where('mime_type','LIKE', '%video/%')->where('model_id', $this->id)->orderBy('order_column')->get();

        return view('livewire.auth.categories.subcategories.products.edit');
    }

    public function store() {
        $this->validate();
        $product = Product::where('id',$this->id)->first();

        $this->uploadFiles();

        $product->update([
            'subCategory_id' => $this->subCategory_id,
            'title_nl' => $this->title_nl,
            'title_de' => $this->title_de,
            'title_en' => $this->title_en,
            'is_active' => $this->is_active,
            'is_active_home' => $this->is_active_home,
            'product_text_nl' => $this->product_text_nl,
            'product_text_de' => $this->product_text_de,
            'product_text_en' => $this->product_text_en,
        ]);

        session()->flash('success','Product geupdate');

        return $this->redirect('/auth/categories/'.$this->headCategory_id.'/subcategories/'.$this->subCategory_id.'/products', navigate: true);
    }

    public function updateFileName($value, $value2) {
        $this->mediaId = $value;
        Media::where('id', $this->mediaId)->update(['friendly_name' => $value2]);
    }

    public function updateImageOrder($list) {
        foreach($list as $item) {
            Media::where('id', $item['value'])->update(['order_column' => $item['order']]);
        }
    }

    public function removeExistingFiles($id) {

        foreach($this->mediaItems as $mediaitem) {
            if($mediaitem->id == $id) {
                $mediaitem->delete();
            }
        }
        $this->dispatch('pondReset');
    }

    #[On('removeFiles')]
    public function removeFiles($filename) {

        Media::where('file_name',$filename)->delete();
    }


    #[On('uploadFiles')]
    public function uploadFiles() {
        $exsistingMedia = $this->product->getMedia('files');


        $mediaArray = [];
        foreach($exsistingMedia as $key => $media) {
            array_push($mediaArray, $media['file_name']);
        }

        $files = collect($this->files);

        foreach($files as $file) {
            if(!in_array($file->getFileName(),$mediaArray)) {
                if(Storage::disk('tmp')->exists($file->getFileName())) {
                    $this->product->addMedia($file->getRealPath())->toMediaCollection('files');
                }

            }
        }

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

    public function cancel() {
        return $this->redirect('/auth/categories/'.$this->headCategory_id.'/subcategories/'.$this->subCategory_id.'/products', navigate: true);
    }

    public function removeHeaderImage () {
        $this->tumbnail = '';
    }

}
