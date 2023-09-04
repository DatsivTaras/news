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
        $sort = [
            'field' => 'id',
            'direction' => 'desc'
        ];
        $files = $this->repository->table([], 10, $sort);
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
            'name' => 'required|string'
        ]);

        $this->repository->uploadAndCreate($request->file, $request->get('name'));

        return redirect(route('admin.files.index'))
            ->with('success', 'You have successfully upload file.')
            ->with('file', $request->get('name'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->repository->getOneOrFail($id)->delete();

        return redirect()->route('admin.files.index')
            ->with('success', 'File deleted successfully');
    }
}
