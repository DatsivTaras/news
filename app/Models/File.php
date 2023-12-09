<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $fillable = ['name', 'path', 'type'];

    public function isImage()
    {
        return strpos($this->type, 'image') !== false ? true : false;
    }

    public function getPath()
    {
        return asset(Storage::url($this->path));
    }
}
