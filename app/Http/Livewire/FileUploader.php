<?php



namespace App\Http\Livewire;



use Livewire\Component;

use Spatie\LivewireFilepond\WithFilePond;



class FileUploader extends Component

{

    use WithFilePond;



    public $file;



    public function save()

    {

        $this->validate([

            'file' => 'required',

        ]);



// Process the uploaded file

        $path = $this->file->store('uploads');



// You can now save $path to your database or perform any other actions



        session()->flash('message', 'File uploaded successfully!');

        $this->reset('file');

    }



    public function render()

    {

        return view('livewire.file-uploader');

    }

}
