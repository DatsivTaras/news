<?php

namespace App\Http\Controllers\Admin;

use App\Filters\AuthorFilter;
use App\Filters\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;
use App\Services\SettingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    private $categoryRepository;
    private $settingRepository;
    private $newsRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        SettingRepository $settingRepository,
        NewsRepository $newsRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;
        $this->newsRepository = $newsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryFilter $request)
    {
        $categories = Category::filter($request)->paginate('22');

        $settingHeadMenu = $this->settingRepository->getOneOrFail('header_menu', 'key');

        return view('admin.category.index', compact('categories', 'settingHeadMenu'))
            ->with('i', (request()->input('page', 1) - 1) * $categories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();

        return view('admin.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(Category::$rules);

        $data['slug'] = Str::slug($data['name'], '_');
        $this->categoryRepository->create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $category = $this->categoryRepository->getOneOrFail($slug, 'slug');
        $categoryId = $category->id;
        $options = [
            'whereHas' => [
                ['category',
                function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId);
                }]
            ]
        ];
        $news = $this->newsRepository->table($options);
        return view('admin.category.show', compact('category', 'news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->getOneOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = request()->validate(Category::$rules);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->categoryRepository->getOneOrFail($id)->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully');
    }
}
