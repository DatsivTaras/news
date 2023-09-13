<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaidNews;
use App\Repositories\HomeSliderRepository;
use App\Repositories\NewsRepository;
use App\Repositories\PaidNewsRepository;
use App\Services\NewsServices;
use Illuminate\Http\Request;

/**
 * Class PaidNewsController
 * @package App\Http\Controllers
 */
class PaidNewsController extends Controller
{
    private $newsServices;
    private $repository;

    public function __construct(
        NewsServices $newsServices,
        PaidNewsRepository $repository
    )
    {
        $this->newsServices = $newsServices;
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sort = [
            'field' => 'id',
            'direction' => 'desc'
        ];

        $paidNews = $this->repository->table([], 20, $sort);

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
        ABORT(404);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
