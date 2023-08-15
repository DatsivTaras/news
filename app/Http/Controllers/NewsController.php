<?php

namespace App\Http\Controllers;

use App\Filters\NewsFilter;
use App\Filters\SearchNews;
use App\Models\Category;
use App\Models\News;
use App\Repositories\CategoryRepository;
use App\Repositories\HomeSliderRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;
use App\Services\CategoryServices;
use App\Services\HomeServices;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsRepository;
    private $homeSliderRepository;

    public function __construct(NewsRepository $newsRepository,
                                HomeSliderRepository $homeSliderRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->homeSliderRepository = $homeSliderRepository;
    }

    public function index()
    {
        $sliderNews = $this->homeSliderRepository->get();
        $mainBlock = HomeServices::getHeaderMainBlockCategory();
        $mainBlocktwo = HomeServices::getHeaderMainBlockCategorytwo();

        return view('index', compact('sliderNews', 'mainBlock', 'mainBlocktwo'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $news = $this->newsRepository->getOneOrFail($slug, 'slug');

        views($news)->record();

        $shareComponent = \Share::page(
            $news->getUrl(),
            $news->title,
        )
            ->facebook()
            ->twitter()
            ->telegram();

        return view('news.show', compact('news', 'shareComponent'));
    }

    public function search(SearchNews $request)
    {

        $news = News::filter($request)->paginate('22');

        return view('news.search', compact('news'));
    }
}
