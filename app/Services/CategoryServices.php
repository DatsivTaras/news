<?php

namespace App\Services;

use App\Classes\Enum\NewsPublicationType;
use App\Models\File;
use App\Models\Image;

use App\Repositories\CategoryRepository;
use App\Repositories\NewsRepository;


/**
 * Class FlightServices
 */
class CategoryServices
{

    private  $categoryRepository;
    private  $newsRepository;

    public function __construct(CategoryRepository $categoryRepository, NewsRepository $newsRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->newsRepository = $newsRepository;
    }

    public static function getCategoryHeaderMenu()
    {
        return app(CategoryRepository::class)->getCategoryHeaderMenu();
    }

    public static function getFooterCategories()
    {
        return app(CategoryRepository::class)->getFooterCategories();
    }

    public function showCategoryNews($slug, $type)
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
        $sort = [
            'field' => 'created_at',
            'direction' => 'DESC'
        ];

        switch ($type) {
            case 'last':
                $news = $this->newsRepository->table($options, 14, $sort);
                break;
            case 'popular':
                $news = $this->newsRepository->getPopularTable($options, 14, $sort);
                break;
            case 'main':
                $options['filters'] = ['type' => NewsPublicationType::IMPORTANT];
                $news = $this->newsRepository->table($options, 14, $sort);
                break;
            default:
                $news = $this->newsRepository->table($options,14, $sort);
        }

        $data = [
            'news'=> $news,
            'category'=> $category
        ];

        return $data;
    }
}
?>
