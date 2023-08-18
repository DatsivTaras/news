<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorsEditRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Repositories\AuthorsRepository;
use App\Repositories\UserRepository;
use App\Services\AuthorServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $authorsRepository;
    private $userRepository;

    private $authorServices;

    public function __construct(
        AuthorsRepository $authorsRepository,
        AuthorServices $authorServices,
        UserRepository $userRepository
    )
    {
        $this->authorServices = $authorServices;
        $this->userRepository = $userRepository;
        $this->authorsRepository = $authorsRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author = $this->authorsRepository->getOneOrFail(auth()->id(), 'user_id');

        return view('admin/profile/index', compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->author->id != $id && !auth()->user()->hasRole('Admin')){
            abort(404);
        }
        $author = $this->authorsRepository->getOneOrFail($id, 'id');

        return view('admin/profile/edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorsEditRequest $request, $id)
    {
        $data = $request->validated();

        $this->authorServices->updateAuthors($id, $data);

        return redirect('/admin/profile');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $this->userRepository->getOneOrFail(auth()->id(), 'id');
        $this->userRepository->update($user, [
            'password' => Hash::make($request->password)
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
