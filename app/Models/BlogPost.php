<?php

namespace App\Models;

use App\Enums\BlogPostSource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $casts = [
        'source' => BlogPostSource::class,
    ];
}
