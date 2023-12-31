<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAuthors extends Model
{
    use HasFactory;

    protected $table = 'news_authors';

    protected $fillable = ['news_id','author_id'];

}
