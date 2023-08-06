<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\HomeSliderRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;
use App\Services\CategoryServices;
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

        return view('index', compact('sliderNews'));
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

        return view('news.show', compact('news'));
    }
}
