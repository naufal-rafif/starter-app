<?php

namespace App\Livewire\Page\Project;

use App\Models\Project;
use Livewire\Component;

class Detail extends Component
{ 
    public Project $project;
    public ?Project $nextProject = null;
    
    public function mount(Project $project)
    {
        $this->project = $project;
        $this->nextProject = $project->getNextProject();
    }
    
    public function render()
    {
        return view('livewire.page.project.detail')->layout('layouts.app');
    }
}
