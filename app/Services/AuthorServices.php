<?php

namespace App\Services;

use App\Models\File;
use App\Models\Image;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\FileRepository;
use App\Repositories\NewsAuthorsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsImageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsTagRepository;
use App\Repositories\TagRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        FileRepository $imageRepository
    )
    {
        $this->authorImagesRepository = $authorImagesRepository;
        $this->authorsRepository = $authorsRepository;
        $this->newsAuthorsRepository = $newsAuthorsRepository;
        $this->imageRepository = $imageRepository;
    }
    public function saveAuthors(array $data)
    {
        $data['slug'] = Str::slug($data['surname'], '_');
        $author = $this->authorsRepository->create($data);
        if (isset($data['image'])) {
            $file = $data['image'];

            $data['name'] = $file->store('public/image/author');
            $image = $this->imageRepository->create($data);

            $data['author_id'] = $author->id;
            $data['image_id'] = $image->id;
            $this->authorImagesRepository->create($data);
        }
    }
    public function updateAuthors($id, $data)
    {
        $author = $this->authorsRepository->getOneOrFail(auth()->user()->author->id, 'id');

        $data['slug'] = Str::slug($data['surname'], '_');
        $this->authorsRepository->update($author, $data);

        if (isset($data['image'])) {
            $imageDelete = $this->authorImagesRepository->getOne($author->id, 'author_id');
            if($imageDelete) {
                $this->authorImagesRepository->delete($imageDelete);
            }
            $file = $data['image'];

            $data['name'] = $file->store('public/image/author');
            $image = $this->imageRepository->create($data);

            $data['author_id'] = $author->id;
            $data['image_id'] = $image->id;
            $this->authorImagesRepository->create($data);
        }
    }
}
?>
