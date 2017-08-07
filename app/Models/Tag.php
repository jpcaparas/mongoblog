<?php

namespace App\Models;

use App\Scopes\CreatedScope;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


/**
 * Class Category
 *
 * @package App\Models
 */
class Tag extends Model
{
    use HasTimestamps, SoftDeletes;

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
     * Posts related to tag
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags')->withTimestamps();
    }
}
