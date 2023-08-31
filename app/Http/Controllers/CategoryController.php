<?php

namespace App\Http\Controllers;

use App\Classes\Enum\NewsPublicationType;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsRepository;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    private $categoryRepository;
    private $categoryServices;
    private $newsRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        CategoryServices $categoryServices,
        NewsRepository $newsRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->newsRepository = $newsRepository;
        $this->categoryServices = $categoryServices;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $category = $this->categoryRepository->getOneOrFail($slug, 'slug');
        $categoryId = $category->id;
        $options = [
            'whereHas' => [
                ['category',
                    function ($query) use ($categoryId) {
                        return $query->where('category_id', $categoryId);
                    }]
            ],
            'viewType' => $request['type']
        ];
        $sort = [
            'field' => 'created_at',
            'direction' => 'DESC'
        ];

        $news = $this->newsRepository->getPaginationNews($options,1, $sort);

//        list($news, $category) = $this->categoryServices->showCategoryNews($data, $slug);
        if ($request->ajax()) {
            $view = view('news._list-news', compact('news'))->render();

            return response()->json(['html' => $view, 'pagin' => $news->hasMorePages()	]);
        }

        return view('category.show', compact('news', 'category'));
    }
}
