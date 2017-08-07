<?php

namespace App\Models;

use App\Scopes\CreatedScope;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
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
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new CreatedScope());
    }

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
     * Posts related to category
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'categories_posts')->withTimestamps();
    }
}
