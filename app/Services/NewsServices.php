<?php

namespace App\Services;

use App\Models\Tag;
use App\Repositories\AuthorImagesRepository;
use App\Repositories\AuthorsRepository;
use App\Repositories\HomeSliderRepository;
use App\Repositories\FileRepository;
use App\Repositories\NewsAuthorsRepository;
use App\Repositories\NewsCategoryRepository;
use App\Repositories\NewsImageRepository;
use App\Repositories\NewsRepository;
use App\Repositories\NewsTagRepository;
use App\Repositories\PaidNewsRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\Str;

/**
 * Class FlightServices
 */
class NewsServices
{
    private $newsRepository;
    private $fileRepository;
    private $newsCategoryRepository;
    private $newsImageRepository;
    private $tagRepository;
    private  $newsTagRepository;
    private  $paidNewsRepository;
    private $authorImagesRepository;
    private $authorsRepository;
    private $newsAuthorsRepository;
    private $homeSliderRepository;
    public function __construct(
        NewsRepository         $newsRepository,
        FileRepository         $fileRepository,
        NewsImageRepository    $newsImageRepository,
        TagRepository          $tagRepository,
        NewsTagRepository      $newsTagRepository,
        NewsCategoryRepository $newsCategoryRepository,
        AuthorImagesRepository $authorImagesRepository,
        AuthorsRepository      $authorsRepository,
        NewsAuthorsRepository  $newsAuthorsRepository,
        HomeSliderRepository   $homeSliderRepository,
        PaidNewsRepository $paidNewsRepository
    )
    {
        $this->newsRepository = $newsRepository;
        $this->fileRepository = $fileRepository;
        $this->newsImageRepository = $newsImageRepository;
        $this->tagRepository = $tagRepository;
        $this->newsTagRepository = $newsTagRepository;
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->authorImagesRepository = $authorImagesRepository;
        $this->paidNewsRepository = $paidNewsRepository;
        $this->authorsRepository = $authorsRepository;
        $this->newsAuthorsRepository = $newsAuthorsRepository;
        $this->homeSliderRepository = $homeSliderRepository;
    }
    public function addNewsOnSlider($request)
    {
        $homeSlider = $this->homeSliderRepository->getOne($request->id, 'news_id');

        if(!$homeSlider) {
            if($this->homeSliderRepository->count() >= 4) {
                $this->homeSliderRepository->deleteLastNewsFromSlider();
            }
             $this->homeSliderRepository->create([
                'news_id' => $request->id,
            ]);
        } else {
            $homeSlider->delete();
        }
    }

    public function addPaidNews($request)
    {
        $paidNews = $this->paidNewsRepository->getOne($request->id, 'news_id');

        if(!$paidNews) {
            if($this->paidNewsRepository->count() >= 5) {
                $this->paidNewsRepository->deleteLastNewsFromPaidNews();
            }
            $this->paidNewsRepository->create([
                'news_id' => $request->id,
            ]);
        } else {
            $paidNews->delete();
        }
    }
    public function saveNews(array $data)
    {
        $news = $this->newsRepository->create($data);

        $data['slug'] = Str::slug($data['title']. ' _ ' . $news->id, '_');
        $this->newsRepository->update($news, $data);

        if (isset($data['image'])) {
            $image = $this->fileRepository->uploadAndCreate($data['image'], $news->title);

            $data['news_id'] = $news->id;
            $data['image_id'] = $image->id;
            $this->newsImageRepository->create($data);
        }

        $Alltags = explode(",", $data['tags']);

        foreach ($Alltags as $ds){
           $tag = Tag::where('name', $ds)->first();
           if($tag) {
                $data['news_id'] = $news->id;
                $data['tags_id'] = $tag->id;
            } else {
                $data['name'] = $ds;
                $ff = $this->tagRepository ->create($data);

                $data['news_id'] = $news->id;
                $data['tags_id'] = $ff->id;
           }
           $this->newsTagRepository->create($data);
        }
        $data['news_id'] = $news->id;
        $data['category_id'] = $data['category_id'];
        $this->newsCategoryRepository->create($data);

        $data['author_id'] = $data['author_id'];
        $data['news_id'] = $news->id;
        $this->newsAuthorsRepository->create($data);

    }
    public function updateNews(object $news, array $data)
    {
        $data['slug'] = Str::slug($data['title']. ' _ ' . $news->id, '_');
        $news->update($data);

        if (isset($data['image'])) {
            $imageDelete = $this->newsImageRepository->getOne($news->id, 'news_id');
            if($imageDelete) {
                $this->newsImageRepository->delete($imageDelete);
            }
            $image = $this->fileRepository->uploadAndCreate($data['image'], $news->title);

            $data['news_id'] = $news->id;
            $data['image_id'] = $image->id;
            $this->newsImageRepository->create($data);
        }
        $tags = explode(',', $data['tags']);

        $this->newsTagRepository->massDeleteByConditions( ['news_id' => $news->id]);

        $Alltags = explode(",", $data['tags']);

        foreach ($Alltags as $ds){
            $tag = Tag::where('name', $ds)->first();
            if($tag) {
                $data['news_id'] = $news->id;
                $data['tags_id'] = $tag->id;
            } else {
                $data['name'] = $ds;
                $ff = $this->tagRepository ->create($data);

                $data['news_id'] = $news->id;
                $data['tags_id'] = $ff->id;
            }
            $this->newsTagRepository->create($data);
        }
        $data['category_id'] = $data['category_id'];
        $data['news_id'] = $news->id;
        $category = $this->newsCategoryRepository->getOneOrFail($news->id, 'news_id');
        $this->newsCategoryRepository->update($category, $data);

        $data['author_id'] = isset($data['author_id']) ? $data['author_id'] : 0;
        $data['news_id'] = $news->id;
        $authors = $this->newsAuthorsRepository->getOneOrFail($news->id, 'news_id');
        $this->newsAuthorsRepository->update($authors, $data);
    }
}
?>
