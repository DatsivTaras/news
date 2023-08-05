<?php

namespace App\Services;

use App\Models\File;
use App\Models\Image;

use App\Repositories\CategoryRepository;


/**
 * Class FlightServices
 */
class CategoryServices
{

    private  $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public static function getCategoryHeaderMenu()
    {
        return app(CategoryRepository::class)->getCategoryHeaderMenu();
    }
}
?>
