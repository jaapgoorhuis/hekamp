<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public $id;
    public $project;
    public $title;
    public $friendly_route;
    public $url;
    public $small_description;
    public $description;
    public $project_category_id;
    public $projectCategorys;
    public $latest_project;
    public $tumbnail;
    public $order_id;
    public $existing_project_images;
    public $project_images= [];

    use WithFileUploads;


    public function mount() {
        $this->project = Project::where('id', $this->id)->first();
        $this->id = Route::current()->parameter('id');
        $this->tumbnail = $this->project->tumbnail;
        $this->small_description = $this->project->small_description;
        $this->description = $this->project->description;
        $this->order_id = $this->project->order_id;
        $this->title = $this->project->title;
        $this->friendly_route = $this->project->friendly_route;
        $this->url = $this->project->url;
        $this->project_category_id = $this->project->project_category_id;
        $this->projectCategorys = ProjectCategories::get();
        $this->existing_project_images =ProjectImages::where('project_id', $this->id)->get();
    }

    public function rules() {
        return
            [
                'title' => ['required','unique:projects,title,'.$this->id],
                'friendly_route' => ['required','unique:projects,friendly_route,'.$this->id],
                'project_category_id' => 'required',
            ];
    }

    public function render()
    {
        return view('livewire.auth.projects.edit');
    }

    public function updateProject() {
        $this->validate();

        if(!is_string($this->tumbnail)) {
            $tumbnail_image = $this->tumbnail->getClientOriginalName();
            $this->tumbnail->storeAs('/public/images/frontend/projects/'.$this->friendly_route.'/', $tumbnail_image);
        }
        else {
            $tumbnail_image = $this->tumbnail;
        }

        $this->project->update([
            'order_id' => $this->order_id,
            'title' => $this->title,
            'friendly_route' => $this->friendly_route,
            'project_category_id' => $this->project_category_id,
            'tumbnail' => $tumbnail_image,
            'url' => $this->url,
            'small_description' => $this->small_description,
            'description' => $this->description,
        ]);

        $just_created_project = Project::orderBy('created_at', 'desc')->first();

        if($this->project_images) {
            $count = 0;
            foreach ($this->project_images as $image) {

                if(str_contains($image, '.tmp')) {
                    $uploadedImage = $image->getClientOriginalName();
                    $count++;

                    ProjectImages::create([
                        'order_id' => '1',
                        'project_id' => $this->id,
                        'image' => $uploadedImage,
                    ]);

                    $image->storeAs('/public/images/frontend/projects/' . $this->friendly_route . '/', $uploadedImage);
                }
            }
        }

        session()->flash('success','Het project is geupdate');
        return $this->redirect('/auth/projects', navigate: true);
    }

    public function removeTumbnailImage () {

        if(Storage::exists('/public/images/frontend/projects/'.$this->friendly_route.'/'.$this->tumbnail)) {
            Storage::delete('/public/images/frontend/projects/'.$this->friendly_route.'/'.$this->tumbnail);
        }

       $this->project->update([
           'tumbnail' => ''
       ]);

        $this->tumbnail = '';
    }

    public function removeImages ($index, $loop) {

        $uploadedImage = ProjectImages::where('id', $index)->first();

        if (Storage::exists('/public/images/frontend/projects/' . $this->friendly_route . '/' . $uploadedImage->image)) {
            Storage::delete('/public/images/frontend/projects/' . $this->friendly_route . '/' . $uploadedImage->image);
        }

        ProjectImages::where('id', $index)->delete();

        $this->existing_project_images = ProjectImages::where('project_id', $this->id)->get();
        if(!$this->existing_project_images) {
            $this->existing_project_images = [];
        }

    }

    public function removeTempImages ($index) {
        array_splice($this->project_images, $index, 1);
    }


    public function cancelProject() {
        return $this->redirect('/auth/projects', navigate: true);
    }

}
