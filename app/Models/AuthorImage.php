<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorImage extends Model
{
    use HasFactory;

    protected $table = 'author_image';

    protected $fillable = ['author_id', 'image_id'];

}
