<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'featured_image',
        'technologies',
        'live_url',
        'github_url',
        'screenshots',
        'features',
        'technical_details'
    ];

    protected $casts = [
        'technologies' => 'array',
        'screenshots' => 'array',
        'features' => 'array',
        'technical_details' => 'array'
    ];

    // Get next project
    public function getNextProject()
    {
        return self::where('id', '>', $this->id)
            ->orderBy('id')
            ->first() ?? self::orderBy('id')->first();
    }

    // Auto-generate slug before saving
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($project) {
            $project->slug = Str::slug($project->title);
        });
    }
}