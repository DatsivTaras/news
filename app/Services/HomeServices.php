<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Setting;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;


/**
 * Class FlightServices
 */
class HomeServices
{

    private $imageRepository;

    private $settingRepository;
    private $newsRepository;
    private $categoryRepository;

    public function __construct(
        ImageRepository $imageRepository,
        SettingRepository $settingRepository,
        NewsRepository $newsRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->newsRepository = $newsRepository;
        $this->imageRepository = $imageRepository;
        $this->settingRepository = $settingRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getHeaderMainBlockCategory()
    {
        $setting = app(SettingRepository::class)->getOne(Setting::BLOCKS_CATEGORY_HOME_PAGE, 'key');
        if (!empty($setting->value)) {
            return app(NewsRepository::class)->getLastNewsForCategoory(explode(',', $setting->value)[0]);
        }
        return null;
    }

    public function getHeaderMainBlockCategorytwo()
    {
        $setting = app(SettingRepository::class)->getOne(Setting::BLOCKS_CATEGORY_HOME_PAGE, 'key');

        if (array_key_exists('1',explode(',', $setting->value)))
        {
            $news1 = app(NewsRepository::class)->getLastNewsForCategoory(explode(',', $setting->value)[1]);
        }

        if (array_key_exists('2',explode(',', $setting->value)))
        {
            $news2 = app(NewsRepository::class)->getLastNewsForCategoory(explode(',', $setting->value)[2]);
        }

        if (isset($news1) && isset($news2)) {
            return collect([
               $news1,
               $news2,
           ]);

        }
    }

  public function getCategoryMainMenu()
  {
      $setting = app(SettingRepository::class)->getOne(Setting::HEADER_CATEGORY_MENU, 'key');

      $categoryIds = explode( ',', $setting->value);
//        dd($category);
      $category = app(CategoryRepository::class)->getCategoryWhereIn($categoryIds);


      return $category;
  }

}
?>
