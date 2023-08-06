<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\NewsRepository;
use App\Repositories\SettingRepository;
use Illuminate\Http\Request;
use function Sodium\compare;

class AdminController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->table();
        return view('admin/index', compact('categories'));
    }

    public function login()
    {
        return view('admin/login');
    }
}
