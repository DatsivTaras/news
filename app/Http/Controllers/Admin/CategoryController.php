<?php

namespace App\Http\Controllers\Admin;

use App\Filters\AuthorFilter;
use App\Filters\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Setting;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRelativeRepisitory;
use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;
use App\Services\SettingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
    private $categoryRelativeRepisitory;

    public function __construct(
        CategoryRepository $categoryRepository,
        SettingRepository $settingRepository,
        NewsRepository $newsRepository,
        CategoryRelativeRepisitory $categoryRelativeRepisitory
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;
        $this->newsRepository = $newsRepository;
        $this->categoryRelativeRepisitory = $categoryRelativeRepisitory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryFilter $request)
    {
        $categories = Category::filter($request)->paginate('30');

        return view('admin.category.index', compact('categories', ))
            ->with('i', (request()->input('page', 1) - 1) * $categories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategory = [];
        $category = new Category();
        $parentCategory +=[
            '' => 'Виберіть Батьківську Категорію'
        ];
        $parentCategory += $this->categoryRepository->getParentsCategoriesForNews();

        return view('admin.category.create', compact('category', 'parentCategory'));
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
        $category = $this->categoryRepository->create($data);

        if ($data['parent_id']) {
            $this->categoryRelativeRepisitory->create([
                'parent_id' => $data['parent_id'],
                'category_id' => $category->id,
            ]);
        }

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
        $news = $this->newsRepository->table($options,30);

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
        $parentCategory = [];
        $parentCategory +=[
            '' => 'Виберіть Батьківську Категорію'
        ];
        $parentCategory += $this->categoryRepository->getParentsCategories($id);

        return view('admin.category.edit', compact('category', 'parentCategory'));
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
        if (!empty($data['parent_id'])){
            if($category->parent) {
                $daughtersCategory = $this->categoryRelativeRepisitory->getOneOrFail($category->id, 'category_id');
                $this->categoryRelativeRepisitory->update($daughtersCategory, [
                    'parent_id' => $data['parent_id'],
                    'category_id' => $category->id
                ]);
            } else {
                $this->categoryRelativeRepisitory->create([
                    'parent_id' => $data['parent_id'],
                    'category_id' => $category->id,
                ]);
            }
        } elseif($category->parent) {
            $this->categoryRelativeRepisitory->delete($category->parent);
        }
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
