<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use App\Repositories\SettingRepository;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $categoryRepository;

    private $settingRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        SettingRepository $settingRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->settingRepository = $settingRepository;
    }

    public function index()
    {
        return view('index');
    }
}
