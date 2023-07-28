<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Repositories\AuthorsRepository;
use App\Services\AuthorServices;
use Illuminate\Http\Request;

/**
 * Class AuthorController
 * @package App\Http\Controllers
 */
class AuthorController extends Controller
{
    private $authorsRepository;
    private $authorServices;

    public function __construct(
        AuthorsRepository $authorsRepository,
        AuthorServices $authorServices
    )
    {
        $this->authorsRepository = $authorsRepository;
        $this->authorServices = $authorServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = $this->authorsRepository->getAuthorsPaginate();

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
        $data = request()->validate(Author::$rules);

        $this->authorServices->saveAuthors($data);

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
        $author = $this->authorsRepository->getOneOrFail($id);

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
        $author = $this->authorsRepository->getOneOrFail($id);

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
        $data = request()->validate(Author::$rules);

        $this->authorServices->updateAuthors($author, $data);

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
        $this->authorsRepository->getOneOrFail($id)->delete();

        return redirect()->route('admin.authors.index')
            ->with('success', 'Author deleted successfully');
    }
}
