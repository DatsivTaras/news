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
use App\Repositories\UserRepository;
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
    private $userRepository;
    private $imageRepository;

    public function __construct(
        AuthorImagesRepository $authorImagesRepository,
        AuthorsRepository $authorsRepository,
        NewsAuthorsRepository $newsAuthorsRepository,
        UserRepository $userRepository,
        FileRepository $fileRepository
    )
    {
        $this->authorImagesRepository = $authorImagesRepository;
        $this->authorsRepository = $authorsRepository;
        $this->newsAuthorsRepository = $newsAuthorsRepository;
        $this->fileRepository = $fileRepository;
        $this->userRepository = $userRepository;
    }
    public function saveAuthors(array $data)
    {
        $data['slug'] = Str::slug($data['surname'] . '_' .$data['user_id'], '_');
        $author = $this->authorsRepository->create($data);

        if (isset($data['image'])) {
            $image = $this->fileRepository->uploadAndCreate($data['image'], $author->name);

            $data['author_id'] = $author->id;
            $data['image_id'] = $image->id;
            $this->authorImagesRepository->create($data);
        }
    }
    public function updateAuthors($id, $data)
    {
        $author = $this->authorsRepository->getOneOrFail($id, 'id');
        $user = $this->userRepository->getOneOrFail($author->user->id, 'id');

        $data['slug'] = Str::slug($data['surname'] . '_' .$user->id, '_');
        $this->authorsRepository->update($author, $data);

        $this->userRepository->update($user, $data);

        if (isset($data['image'])) {
            $imageDelete = $this->authorImagesRepository->getOne($author->id, 'author_id');
            if($imageDelete) {
                $this->authorImagesRepository->delete($imageDelete);
            }

            $image = $this->fileRepository->uploadAndCreate($data['image'], $author->name);

            $data['author_id'] = $author->id;
            $data['image_id'] = $image->id;
            $this->authorImagesRepository->create($data);
        }
    }
}
?>
