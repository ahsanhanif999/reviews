<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'title',
        'slug',
        'description',
        'status',
        'audio_file'
    ];

    /**
     * Get the company associated with the post.
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user who created the post
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the tags associated with a post.
     */
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
