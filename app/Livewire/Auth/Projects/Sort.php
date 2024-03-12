<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Page;
use App\Models\PageContent;
use App\Models\PageText;
use App\Models\Project;
use App\Models\ProjectImages;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Sort extends Component
{
    public $id;
    public $projectImages;
    public $project;


    public function mount() {
        $this->id = Route::current()->parameter('id');
        $this->project = Project::where('id', $this->id)->first();
    }

    public function render()
    {

        $this->projectImages = ProjectImages::where('project_id', $this->id)->orderBy('order_id', 'asc')->get();


        return view('livewire.auth.projects.sort');
    }

    public function cancel() {
        return $this->redirect('/auth/projects', navigate: true);
    }

    public function updateProjectImageOrder($list) {

        foreach($list as $item) {
            ProjectImages::find($item['value'])->update(['order_id' => $item['order']]);
        }
        return view('livewire.auth.projects.projects');
    }
}
