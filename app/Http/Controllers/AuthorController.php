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

    public function index(Request $request, $slug)
    {
        $author = $this->authorsRepository->getOneOrFail($slug ,'slug');

        $authorId = $author->id;
        $perPage = 20;
        $options = [
            'whereHas' => [
                ['author',
                    function ($query) use ($authorId) {
                        return $query->where('author_id', $authorId);
                    }]
            ]
        ];
        $sort = [
            'field' => 'created_at',
            'direction' => 'DESC'
        ];
        $news = $this->newsRepository->getPaginationNews($options,20, $sort);

        if ($request->ajax()) {
            $view = view('news.parts._list-news', compact('news'))->render();

            return response()->json(['html' => $view, 'pagin' => $news->hasMorePages()	]);
        }

        return view('authors.index', compact('author','news'));
    }
}
