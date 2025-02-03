<?php

namespace App\Livewire\Auth\Download;

use App\Models\MenuItems;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Download extends Component
{
    public $id;
    public $downloads;
    public $files = [];
    public $existingFiles;


    use WithFileUploads;
    use WithFilePond;


    public function render()
    {
        $this->downloads = \App\Models\Download::first();
        $this->id = $this->downloads->id;
        $this->existingFiles = $this->downloads->getMedia('downloads');
        return view('livewire.auth.download.download');
    }


    public function updateImageOrder($list) {

        foreach($list as $item) {
            Media::where('id', $item['value'])->update(['order_column' => $item['order']]);
        }
        $this->dispatch('updated');

    }

    public function removeExistingFiles($id) {
        foreach($this->existingFiles as $mediaitem) {
            if($mediaitem->id == $id) {
                $mediaitem->delete();
            }
        }
        $this->dispatch('pondReset');
    }

    public function updateFileName($value, $value2) {
        $this->mediaId = $value;
        Media::where('id', $this->mediaId)->update(['friendly_name' => $value2]);
    }
    #[On('removeFiles')]
    public function removeFiles($filename) {
        Media::where('file_name',$filename)->delete();
    }


    #[On('uploadFiles')]
    public function uploadFiles() {
        $exsistingMedia = $this->downloads->getMedia('downloads');


        $mediaArray = [];
        foreach($exsistingMedia as $key => $media) {
            array_push($mediaArray, $media['file_name']);
        }

        $files = collect($this->files);



        foreach($files as $file) {
            if(!in_array($file->getFileName(),$mediaArray)) {
                if(Storage::disk('tmp')->exists($file->getFileName())) {
                    $this->downloads->addMedia($file->getRealPath())->withCustomProperties(['extension' => $file->getClientOriginalExtension()])->toMediaCollection('downloads');
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
}
