<?php

namespace App\Livewire\Page;

use App\Models\Blog;
use App\Models\Project;
use Livewire\Component;

class Home extends Component
{ 
    public function render()
    {
        return view('livewire.page.home', [
            'blogs' => Blog::published()->get(),
            'projects' => Project::get(),
        ])->layout('layouts.app');
    }
}
