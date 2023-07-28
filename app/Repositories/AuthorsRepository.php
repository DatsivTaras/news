<?php

namespace App\Repositories;

use App\Models\Author;
use App\Models\News;
use App\Models\Tag;
use App\Repositories\BaseRepository;

class AuthorsRepository extends BaseRepository
{
    protected function getModelClass(): string
    {
        return Author::class;
    }

    public function getAuthors()
    {
        $authors = Author::pluck('name', 'id')->toArray();

        return $authors;
    }

    public function getAuthorsPaginate()
    {
        $authors = $this->getQuery()->paginate('15');

        return $authors ;
    }
}
