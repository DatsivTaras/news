<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Page;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class FileController
 * @package App\Http\Controllers
 */
class FileController extends Controller
{
    private $repository;

    public function __construct(
        FileRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = $this->repository->table();
        return view('admin.file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file = new File();
        return view('admin.file.create', compact('file'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $fileName = time() . '.' . $request->file->extension();

        $request->file->store('public/image/news');

        return back()
            ->with('success', 'You have successfully upload file.')
            ->with('file', $fileName);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = $this->pageRepository->getOneOrFail($id);

        return view('admin.page.show', compact('page'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->pageRepository->getOneOrFail($id)->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully');
    }
}
