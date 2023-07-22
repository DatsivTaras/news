<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\AuthorImage;
use App\Models\News;
use App\Models\Tag;
use App\Repositories\BaseRepository;

class AuthorImagesRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return AuthorImage::class;
    }

    public function getAuthors()
    {
        $authors = Author::pluck('name', 'id')->toArray();

        return $authors;
    }
}
