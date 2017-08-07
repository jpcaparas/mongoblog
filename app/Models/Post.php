<?php

namespace App\Models;

use App\Scopes\CreatedScope;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Post
 *
 * @package App\Models
 */
class Post extends Model
{
    use HasSlug, HasTimestamps, SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'is_published',
        'user_id',
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

    /**
     * Categories related to post
     *
     * @return BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_posts')->withTimestamps();
    }

    /**
     * Tags related to post
     *
     * @return BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags')->withTimestamps();
    }
}
