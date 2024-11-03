<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'reading_time',
        'category_id',
        'author_id',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    // Relationship with User (Author)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Get related posts
    public function getRelatedPosts()
    {
        return self::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->limit(2)
            ->latest()
            ->get();
    }

    // Status accessors
    public function getIsPublishedAttribute(): bool
    {
        return $this->published_at && $this->published_at <= now();
    }

    public function getIsScheduledAttribute(): bool
    {
        return $this->published_at && $this->published_at > now();
    }

    public function getStatusAttribute(): string
    {
        if ($this->is_published) {
            return 'Published';
        }
        if ($this->is_scheduled) {
            return 'Scheduled';
        }
        return 'Draft';
    }

    // Auto-generate slug before saving
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($blog) {
            if (is_null($blog->author_id)) {
                $blog->author_id = auth()->id();
            }
            $blog->slug = Str::slug($blog->title);
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title')) {
                $blog->slug = Str::slug($blog->title);
            }
        });
    }

    // Scope for published posts
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    // Scope for scheduled posts
    public function scopeScheduled($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '>', now());
    }

    // Scope for drafts
    public function scopeDrafts($query)
    {
        return $query->whereNull('published_at');
    }
}