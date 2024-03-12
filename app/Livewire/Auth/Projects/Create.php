<?php

namespace App\Livewire\Auth\Projects;

use App\Models\PageBlock;
use App\Models\Project;
use App\Models\ProjectCategories;
use App\Models\ProjectImages;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithFileUploads;
use mysql_xdevapi\Schema;

class Create extends Component
{

    public $id;
    public $project;
    public $title;
    public $friendly_route;
    public $url;
    public $small_description;
    public $description;
    public $project_category_id = '1';
    public $projectCategorys;
    public $latest_project;
    public $tumbnail;
    public $project_images=[];

    use WithFileUploads;

    public function mount() {
        $this->id = Route::current()->parameter('id');
    }

    public function render()
    {
        $this->latest_project = Project::orderBy('order_id', 'desc')->first();

        $this->project = Project::where('id', $this->id)->first();
        $this->projectCategorys = ProjectCategories::get();
        return view('livewire.auth.projects.create');
    }

    protected $rules = [
        'title' => 'required|unique:projects',
        'friendly_route' => 'required|unique:projects',
        'project_category_id' => 'required',
    ];

    public function storeProject() {

        $this->validate();

        if($this->tumbnail) {
            $tumbnail_image = $this->tumbnail->getClientOriginalName();
            $this->tumbnail->storeAs('/public/images/frontend/projects/'.$this->friendly_route.'/', $tumbnail_image);
        }
        else {
            $tumbnail_image = '';
        }

        Project::create([
            'order_id' => $this->latest_project->order_id +1,
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
            foreach($this->project_images as $image) {
                ProjectImages::create([
                    'order_id' => '1',
                    'project_id' => $just_created_project->id,
                    'image' => $image->getClientOriginalName()
                ]);
                $image->storeAs('/public/images/frontend/projects/'.$this->friendly_route.'/', $image->getClientOriginalName());
            }
        }

        session()->flash('success','Het project is toegevoegd');
        return $this->redirect('/auth/projects', navigate: true);
    }

    public function cancelProject() {
        return $this->redirect('/auth/projects', navigate: true);
    }

    public function removeImages ($index) {
        array_splice($this->project_images, $index, 1);
    }

    public function removeTumbnailImage () {
        $this->tumbnail = '';
    }


}
