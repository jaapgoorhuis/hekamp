<?php

namespace App\Livewire\Frontend\ProjectDetail;

use App\Models\Project;
use Livewire\Component;

class ProjectDetail extends Component
{
    public $project;


    public function mount($slug) {
        $this->project = Project::where('friendly_route', $slug)->first();
    }
    public function render()
    {

        return view('livewire.frontend.projectDetail.projectDetail');
    }
}
