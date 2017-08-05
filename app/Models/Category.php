<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Category
 *
 * @package App\Models
 */
class Category extends Model
{
    use HasSlug, HasTimestamps, SoftDeletes;

    protected $fillable = [
        'name',
        'post_id',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
                  ->generateSlugsFrom('name')
                  ->saveSlugsTo('slug')
                  ->slugsShouldBeNoLongerThan(50);
    }

    /**
     * User which post belongs to
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'categories_posts')->withTimestamps();
    }
}
