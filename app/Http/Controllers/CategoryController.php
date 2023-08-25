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
    public function show(Request $request ,$slug)
    {
       $type = $request->type;

        return view('category.show', $this->categoryServices->showCategoryNews($slug, $type));
    }
}
