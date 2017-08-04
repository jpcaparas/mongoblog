<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Post
 *
 * @package App\Models
 */
class Post extends Model
{
    use HasSlug;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'is_published',
        'user_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                  ->generateSlugsFrom('title')
                  ->saveSlugsTo('slug')
                  ->slugsShouldBeNoLongerThan(50);
    }

    /**
     * User which post belongs to
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
