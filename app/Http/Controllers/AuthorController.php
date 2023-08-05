<?php

namespace App\Http\Controllers;

use App\Repositories\AuthorsRepository;
use App\Services\AuthorServices;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $authorsRepository;

    public function __construct(
        AuthorsRepository $authorsRepository
    )
    {
        $this->authorsRepository = $authorsRepository;
    }

    public function index($slug) {

        $author = $this->authorsRepository->getOneOrFail($slug ,'slug');

        return $slug;
    }
}
