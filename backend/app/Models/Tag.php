<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'is_active',
        'slug',
        'created_by'
    ];

    /**
     * Get the user who created the post
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the posts associated with a tag.
     */
    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}
