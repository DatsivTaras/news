<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Setting;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Services\NewsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class PageController
 * @package App\Http\Controllers
 */
class PageController extends Controller
{
    private $pageRepository;
    private $settingRepository;
    public function __construct(
        PageRepository $pageRepository,
        SettingRepository $settingRepository
    )
    {
        $this->pageRepository = $pageRepository;
        $this->settingRepository = $settingRepository;
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

        $pages = $this->pageRepository->table([], 10, $sort);

        return view('admin.page.index', compact('pages'))
            ->with('i', (request()->input('page', 1) - 1) * $pages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = new Page();
        return view('admin.page.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(Page::$rules);

        $data['slug'] = Str::slug($data['title'], '_');
        $this->pageRepository->create($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->getOneOrFail($id);

        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $data = request()->validate(Page::$rules);

        $this->pageRepository->update($page, $data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully');
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
