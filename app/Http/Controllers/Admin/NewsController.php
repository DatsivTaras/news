<?php

namespace App\Http\Controllers\Admin;

use App\Filters\NewsFilter;
use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\News;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\HomeSliderRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsRepository;
use App\Services\NewsServices;
use Illuminate\Http\Request;

/**
 * Class NewsController
 * @package App\Http\Controllers
 */
class NewsController extends Controller
{
    private $newsRepository;

    private $newsServices;

    private $categoryRepository;
    private $homeSliderRepository;

    private $authorsRepository;

    public function __construct(
        NewsRepository $newsRepository,
        NewsServices $newsServices,
        CategoryRepository $categoryRepository,
        HomeSliderRepository $homeSliderRepository,
        AuthorsRepository $authorsRepository
    )
    {
        $this->newsServices = $newsServices;
        $this->newsRepository = $newsRepository;
        $this->categoryRepository = $categoryRepository;
        $this->authorsRepository = $authorsRepository;
        $this->homeSliderRepository = $homeSliderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NewsFilter $request)
    {
        $news = News::filter($request)->paginate('22');

        return view('admin.news.index', compact('news'))
            ->with('i', (request()->input('page', 1) - 1) * $news->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $image = '';
        $news = new News();
        $news->category = request()->get('category_id');
        $categories = $this->categoryRepository->getCategories();
        $authors = $this->authorsRepository->getAuthors();

        return view('admin.news.create', compact('news', 'tags', 'image', 'categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(News::$rules);

        $this->newsServices->saveNews($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = $this->newsRepository->getOneOrFail($id);

        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = $this->newsRepository->getOneOrFail($id);
        $categories = $this->categoryRepository->getCategories();
        $authors = $this->authorsRepository->getAuthors();

        $image = implode("','", $news->image->pluck('name')->toArray());
        $tags = implode(",", $news->tags->pluck('name')->toArray());
        return view('admin.news.edit', compact('news','tags', 'image', 'categories', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $data = request()->validate(News::$rules);

        $this->newsServices->updateNews($news, $data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully');
    }

    public function addNewsOnSlider(Request $request)
    {
        $this->newsServices->addNewsOnSlider($request);

        return response()->json(true);
    }
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $news = $this->newsRepository->getOneOrFail($id);
        $this->newsRepository->delete($news);

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully');
    }
}
