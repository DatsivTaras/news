<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\File;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsRepository;
use App\Services\AuthorServices;
use App\Services\NewsServices;
use Illuminate\Http\Request;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{
    private $newsRepository;
    private $newsServices;
    private $categoryRepository;
    private $newsCategoryRepository;
    private $authorsRepository;
    private $authorServices;
    private $authorImagesRepository;

    public function __construct(
        NewsRepository $newsRepository,
        NewsServices $newsServices,
        CategoryRepository $categoryRepository,
        NewsCategoryRepository $newsCategoryRepository,
        AuthorsRepository $authorsRepository,
        AuthorServices $authorServices,
        AuthorImagesRepository $authorImagesRepository
    )
    {
        $this->newsServices = $newsServices;
        $this->newsRepository = $newsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->authorsRepository = $authorsRepository;
        $this->authorImagesRepository = $authorImagesRepository;
        $this->authorServices = $authorServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate();

        return view('admin.author.index', compact('authors'))
            ->with('i', (request()->input('page', 1) - 1) * $authors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $image = '';
        $author = new Author();

        return view('admin.author.create', compact('author','image'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Author::$rules);

        $author = $this->authorServices->saveAuthors($request);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);

        return view('admin.author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        $image = implode("','", $author->image->pluck('name')->toArray());

        return view('admin.author.edit', compact('author', 'image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Author $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        request()->validate(Author::$rules);

        $this->authorServices->updateAuthors($author, $request);

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $author = Author::find($id)->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author deleted successfully');
    }
}
