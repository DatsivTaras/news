<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorsRepository;
use App\Repositories\NewsRepository;
use App\Services\AuthorServices;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorsRepository;
    private $newsRepository;

    public function __construct(
        AuthorsRepository $authorsRepository,
        NewsRepository $newsRepository
    )
    {
        $this->authorsRepository = $authorsRepository;
        $this->newsRepository = $newsRepository;
    }

    public function index($slug) {

        $author = $this->authorsRepository->getOneOrFail($slug ,'slug');
//        $category = $this->categoryRepository->getOneOrFail($slug, 'slug');
        $authorId = $author->id;
        $perPage = 30;
        $options = [
            'whereHas' => [
                ['author',
                    function ($query) use ($authorId) {
                        return $query->where('author_id', $authorId);
                    }]
            ]
        ];
        $news = $this->newsRepository->table($options, $perPage);

        return view('authors.index', compact('author','news'));
    }
}
