<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Page;
use App\Models\PageContent;
use App\Models\PageText;
use App\Models\Project;
use App\Models\ProjectImages;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Delete extends Component
{
    public $id;

    public function render()
    {
        $this->id = Route::current()->parameter('id');
        return view('livewire.auth.projects.delete');
    }

    public function cancel() {
        return $this->redirect('/auth/projects', navigate: true);
    }

    public function remove()
    {
        Project::find($this->id)->delete();
        $projectImages = ProjectImages::where('project_id', $this->id)->delete();


        session()->flash('success',"Het project is verwijderd");

        return $this->redirect('/auth/projects', navigate: true);
    }
}
