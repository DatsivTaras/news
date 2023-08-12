<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRelative extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'category_id',
    ];

    protected $table = 'category_relation';


}
