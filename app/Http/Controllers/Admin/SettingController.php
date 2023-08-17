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
        $settingsCategories = Setting::get()->groupBy(function($data) {
            return $data->category;
        });

        return view('admin.setting.index', compact('settingsCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addItemsSettings(Request $request)
    {
        $setting = $this->settingRepository->getOneOrFail(Setting::HEADER_ITEMS_MENU, 'key');
        if ($request->type == 'category') {
            $model = $this->categoryRepository->getOneOrFail($request->id);
        }
        if ($request->type == 'page') {
            $model = $this->pageRepository->getOneOrFail($request->id);
        }

        $newName = $model->getName() . ' | ' . $model->getUrl();

        if(!strripos($setting->value, $model->getUrl())) {
            $this->settingRepository->update($setting, [
                'value' => $setting->value . ($setting->value ? PHP_EOL : '') . $newName
            ]);
        } else {
            if (strripos($setting->value, $model->getUrl() . PHP_EOL)) {
                $val = str_replace( $newName . PHP_EOL, "", $setting->value);
            } else {
                $val = str_replace( $newName, "", $setting->value);
            }
            $this->settingRepository->update($setting, [
                'value' =>  $val
            ]);
        }

        return response()->json($setting->value);
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
