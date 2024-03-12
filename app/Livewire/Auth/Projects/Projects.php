<?php

namespace App\Livewire\Auth\Projects;

use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageContent;
use App\Models\PageText;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Projects extends Component
{
    public $projects;

    use WithFileUploads;


    public function render()
    {
        $this->projects = Project::orderBy('order_id', 'asc')->get();
        return view('livewire.auth.projects.projects');
    }

    public function createProject() {
        return $this->redirect('/auth/projects/create', navigate: true);
    }

    public function editProject($id) {
        return $this->redirect('/auth/projects/edit/'.$id, navigate: true);
    }

    public function sortProjectImages($id) {

        return $this->redirect('/auth/projects/sort/'.$id, navigate: true);
    }


    public function deleteProject($id) {

        return $this->redirect('/auth/projects/delete/'.$id, navigate: true);
    }

    public function updateProjectOrder($list) {

        foreach($list as $item) {
            Project::find($item['value'])->update(['order_id' => $item['order']]);
        }
        return view('livewire.auth.projects.projects');
    }
}
