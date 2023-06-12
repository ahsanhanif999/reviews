<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'shop_name',
        'product',
        'title',
        'slug',
        'description',
        'status',
        'audio_file'
    ];
}
