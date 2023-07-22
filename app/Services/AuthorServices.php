<?php

namespace App\Services;

use App\Models\File;
use App\Models\Image;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\ImageRepository;
use App\Repositories\NewsAuthorsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsImageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsTagRepository;
use App\Repositories\TagRepository;
use Carbon\Carbon;

/**
 * Class FlightServices
 */
class AuthorServices
{
    private $authorImagesRepository;
    private $authorsRepository;
    private $newsAuthorsRepository;
    private $imageRepository;

    public function __construct(
        AuthorImagesRepository $authorImagesRepository,
        AuthorsRepository $authorsRepository,
        NewsAuthorsRepository $newsAuthorsRepository,
        ImageRepository $imageRepository
    )
    {
        $this->authorImagesRepository = $authorImagesRepository;
        $this->authorsRepository = $authorsRepository;
        $this->newsAuthorsRepository = $newsAuthorsRepository;
        $this->imageRepository = $imageRepository;
    }
    public function saveAuthors($request)
    {
        $author = $this->authorsRepository->create($request->all());
        $file = $request->image;
        $data['name'] = $file->store('public/image/author');
        $image = $this->imageRepository->create($data);

        $data['author_id'] = $author->id;
        $data['image_id'] = $image->id;
        $this->authorImagesRepository->create($data);
    }
    public function updateAuthors($author, $request)
    {
        $author->update($request->all());

        if ($request->image) {
            $imageDelete = $this->authorImagesRepository->getOne($author->id, 'author_id');
            if($imageDelete) {
                $this->authorImagesRepository->delete($imageDelete);
            }
            $file = $request->image;

            $data['name'] = $file->store('public/image/author');
            $image = $this->imageRepository->create($data);

            $data['author_id'] = $author->id;
            $data['image_id'] = $image->id;
            $this->authorImagesRepository->create($data);
        }
    }
}
?>
