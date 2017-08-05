<?php

namespace App\Models;

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
     * Posts related to tag
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'posts_tags')->withTimestamps();
    }
}
