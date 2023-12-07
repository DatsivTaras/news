<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Setting;
use App\Repositories\CategoryRepository;
use App\Repositories\FileRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;


/**
 * Class FlightServices
 */
class HomeServices
{

    private $imageRepository;
    private $pageRepository;
    private $settingRepository;
    private $newsRepository;
    private $categoryRepository;

    public function __construct(
        FileRepository     $imageRepository,
        SettingRepository  $settingRepository,
        NewsRepository     $newsRepository,
        PageRepository     $pageRepository,
        CategoryRepository $categoryRepository
    )
    {
        $this->newsRepository = $newsRepository;
        $this->imageRepository = $imageRepository;
        $this->settingRepository = $settingRepository;
        $this->categoryRepository = $categoryRepository;
        $this->pageRepository = $pageRepository;
    }

    public static function getHeaderMainBlockCategory()
    {
        $setting = app(SettingRepository::class)->getOne(Setting::BLOCKS_CATEGORY_HOME_PAGE, 'key');
        if (!empty($setting->value)) {
            return app(NewsRepository::class)->getLastNewsForCategoory(explode(',', $setting->value)[0]);
        }
        return null;
    }

    public static function getHeaderMainBlockCategorytwo()
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

    public static function getCategoryLeftMenu()
    {
        $setting = app(SettingRepository::class)->getOne(Setting::HEADER_ITEMS_LEFT_MENU, 'key');

        $categoryIds = explode( ',', $setting->value);

        $category = app(CategoryRepository::class)->getCategoryWhereIn($categoryIds);

        return $category;
    }
  public static function getCategoryMainMenu()
  {
      $setting = app(SettingRepository::class)->getOne(Setting::HEADER_CATEGORY_MENU, 'key');

      $categoryIds = explode( ',', $setting->value);

      $category = app(CategoryRepository::class)->getCategoryWhereIn($categoryIds);

      return $category;
  }

    public function getFooterPageCompany($type)
    {
        $setting = app(SettingRepository::class)->getOne($type, 'key');

        $pageIds = explode( ',', $setting->value);

        $page = app(PageRepository::class)->getPageWhereIn($pageIds);

        return $page;
    }
}
?>
