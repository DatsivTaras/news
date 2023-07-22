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
class NewsServices
{
    private $newsRepository;
    private $imageRepository;
    private $newsCategoryRepository;
    private $newsImageRepository;
    private $tagRepository;
    private  $newsTagRepository;
    private $authorImagesRepository;
    private $authorsRepository;
    private $newsAuthorsRepository;
    public function __construct(
        NewsRepository $newsRepository,
        ImageRepository $imageRepository,
        NewsImageRepository $newsImageRepository,
        TagRepository $tagRepository,
        NewsTagRepository $newsTagRepository,
        NewsCategoryRepository $newsCategoryRepository,
        AuthorImagesRepository $authorImagesRepository,
        AuthorsRepository $authorsRepository,
        NewsAuthorsRepository $newsAuthorsRepository
    )
    {
        $this->newsRepository = $newsRepository;
        $this->imageRepository = $imageRepository;
        $this->newsImageRepository = $newsImageRepository;
        $this->tagRepository = $tagRepository;
        $this->newsTagRepository = $newsTagRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->authorImagesRepository = $authorImagesRepository;
        $this->authorsRepository = $authorsRepository;
        $this->newsAuthorsRepository = $newsAuthorsRepository;
    }
    public function saveNews( $request)
    {
        $news = $this->newsRepository->create($request->all());
        $file = $request->image;
        if ($request->image) {
            $data['name'] = $file->store('public/image/planes');
            $image = $this->imageRepository->create($data);

            $data['news_id'] = $news->id;
            $data['image_id'] = $image->id;
            $this->newsImageRepository->create($data);
        }
        $tags = explode(',', $request->tags);

        foreach($tags as $tag) {
            $data['name'] = $tag;
            $tag = $this->tagRepository->create($data);

            $data['news_id'] = $news->id;
            $data['tags_id'] = $tag->id;
            $this->newsTagRepository ->create($data);
        }

        $data['news_id'] = $news->id;
        $data['category_id'] = $request->category_id;
        $this->newsCategoryRepository->create($data);

        $data['author_id'] = $request->category_id;
        $data['news_id'] = $news->id;
        $this->newsAuthorsRepository->create($data);
    }
    public function updateNews($news, $request)
    {
        $news->update($request->all());

        if ($request->image) {
            $imageDelete = $this->newsImageRepository->getOne($news->id, 'news_id');
            if($imageDelete) {
                $this->newsImageRepository->delete($imageDelete);
            }
            $file = $request->image;
            $image = new File();

            $data['name'] = $file->store('public/image/planes');
            $image = $this->imageRepository->create($data);

            $data['news_id'] = $news->id;
            $data['image_id'] = $image->id;
            $this->newsImageRepository->create($data);
        }
        $tags = explode(',', $request->tags);

        $this->newsTagRepository->massDeleteByConditions( ['news_id' => $news->id]);

        foreach($tags as $tag) {
            $data['name'] = $tag;
            $tag = $this->tagRepository->create($data);

            $data['news_id'] = $news->id;
            $data['tags_id'] = $tag->id;
            $this->newsTagRepository ->create($data);
        }
        $data['category_id'] = $request->category_id;
        $data['news_id'] = $news->id;
        $category = $this->newsCategoryRepository->getOneOrFail($news->id, 'news_id');
        $this->newsCategoryRepository->update($category, $data);

        $data['author_id'] = $request->author_id;
        $data['news_id'] = $news->id;
        $authors = $this->newsAuthorsRepository->getOneOrFail($news->id, 'news_id');
        $this->newsAuthorsRepository->update($authors, $data);
    }
}
?>
