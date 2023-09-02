<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaidNews;
use App\Repositories\HomeSliderRepository;
use App\Repositories\NewsRepository;
use App\Services\NewsServices;
use Illuminate\Http\Request;

/**
 * Class PaidNewsController
 * @package App\Http\Controllers
 */
class PaidNewsController extends Controller
{
    private $newsServices;

    public function __construct(
        NewsServices $newsServices
    )
    {
        $this->newsServices = $newsServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paidNews = PaidNews::paginate();

        return view('admin.paid-news.index', compact('paidNews'))
            ->with('i', (request()->input('page', 1) - 1) * $paidNews->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $paidNews = new PaidNews();
        return view('admin.paid-news.create', compact('paidNews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->newsServices->addPaidNews($request);

        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paidNews = PaidNews::find($id);

        return view('admin.paid-news.show', compact('paidNews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paidNews = PaidNews::find($id);

        return view('admin.paid-news.edit', compact('paidNews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PaidNews $paidNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaidNews $paidNews)
    {
        request()->validate(PaidNews::$rules);

        $paidNews->update($request->all());

        return redirect()->route('admin.paid-news.index')
            ->with('success', 'PaidNews updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paidNews = PaidNews::find($id)->delete();

        return redirect()->route('admin.paid-news.index')
            ->with('success', 'PaidNews deleted successfully');
    }
}
