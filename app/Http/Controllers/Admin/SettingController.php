<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\CategoryRepository;
use App\Repositories\ImageRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Services\SettingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function Illuminate\Events\queueable;

/**
 * Class SettingController
 * @package App\Http\Controllers
 */
class SettingController extends Controller
{
    private $settingServices;
    private $settingRepository;
    private $categoryRepository;
    private $pageRepository;

    public function __construct(
        SettingServices $settingServices,
        SettingRepository $settingRepository,
        CategoryRepository $categoryRepository,
        PageRepository $pageRepository
    )
    {
        $this->settingServices = $settingServices;
        $this->settingRepository = $settingRepository;
        $this->categoryRepository = $categoryRepository;
        $this->pageRepository = $pageRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::get()->groupBy(function($data) {
            return $data->category;
        });

        return view('admin.setting.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addItemsSettings(Request $request)
    {
        $setting = $this->settingRepository->getOneOrFail('header_items_menu', 'key');
        if ($request->type == 'category') {
            $model = $this->categoryRepository->getOneOrFail($request->id);
        }
        if ($request->type == 'page') {
            $model = $this->pageRepository->getOneOrFail($request->id);
        }

        if(!strripos($setting->value, $model->getUrl())) {
            $this->settingRepository->update($setting, [
                'value' => $setting->value . ($setting->value ? PHP_EOL : '') . $model->getName() . ' | ' . $model->getUrl()
            ]);
        } else {
            $this->settingRepository->update($setting, [
                'value' => str_replace( $model->getName() . ' | ' . $model->getUrl(), "", $setting->value)
            ]);
        }

        return response()->json($setting->value);
    }

    public function create()
    {

        return view('admin.setting.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->settingServices->saveSettings($request);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        return view('setting.show', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $setting = Setting::find($id);
//
//        return view('setting.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
//        dd('d');
//        request()->validate(Setting::$rules);
//
//        $setting->update($request->all());
//
//        return redirect()->route('settings.index')
//            ->with('success', 'Setting updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
//        $setting = Setting::find($id)->delete();
//
//        return redirect()->route('settings.index')
//            ->with('success', 'Setting deleted successfully');
    }
}
