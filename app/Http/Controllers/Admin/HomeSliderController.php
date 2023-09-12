<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Repositories\HomeSliderRepository;
use Illuminate\Http\Request;

/**
 * Class HomeSliderController
 * @package App\Http\Controllers
 */
class HomeSliderController extends Controller
{
    private $homeSliderRepository;

    public function __construct(
        HomeSliderRepository $homeSliderRepository
    )
    {
        $this->homeSliderRepository = $homeSliderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeSliders = $this->homeSliderRepository->getSliderNews();

        return view('admin.home-slider.index', compact('homeSliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $homeSlider = new HomeSlider();
//        return view('home-slider.create', compact('homeSlider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return redirect()->route('home-sliders.index')
            ->with('success', 'HomeSlider created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $homeSlider = HomeSlider::find($id);
//
//        return view('home-slider.edit', compact('homeSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  HomeSlider $homeSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeSlider $homeSlider)
    {

        return redirect()->route('home-sliders.index')
            ->with('success', 'HomeSlider updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        $this->homeSliderRepository->getOneOrFail($id)->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'HomeSlider deleted successfully');
    }
}
