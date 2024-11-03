<?php

namespace App\Livewire\Page\Blog;

use App\Models\Blog;
use Livewire\Component;

class Detail extends Component
{
    public Blog $blog;
    
    // Mount method will automatically receive the blog model through route model binding
    public function mount(Blog $blog)
    {
        $this->blog = $blog;
    }
    public function render()
    {
        $relatedPosts = $this->blog->getRelatedPosts();
        if(!auth()->user()){
            $blog = $this->blog->published()->first();
            if($blog === null) {
                return abort(404);
            }
            $this->blog = $blog;
        }
        return view('livewire.page.blog.detail', [
            'relatedPosts' => $relatedPosts,
        ])->layout('layouts.app');
    }

    public function share($platform)
    {
        $url = route('app.blog.details', $this->blog);
        
        $shareUrls = [
            'twitter' => "https://twitter.com/intent/tweet?url=" . urlencode($url) . "&text=" . urlencode($this->blog->title),
            'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url=" . urlencode($url)
        ];

        return redirect()->away($shareUrls[$platform]);
    }
}
