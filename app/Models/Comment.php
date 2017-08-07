<?php

namespace App\Models;

use App\Scopes\CreatedScope;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasTimestamps, SoftDeletes;

    protected $fillable = [
        'author',
        'author_email',
        'author_url',
        'author_ip',
        'author_agent',
        'content',
        'post_id'
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
     * Post which comment belongs to
     *
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
