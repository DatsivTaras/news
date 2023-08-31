<?php

namespace App\Widgets;

use App\Classes\Enum\NewsPublicationType;
use App\Models\News;
use App\Repositories\NewsRepository;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Validation\Rules\Enum;

class SimilarNews extends AbstractWidget
{
    private $newsRepository;

    public function __construct(array $config = [])
    {
        $this->newsRepository = app(NewsRepository::class);
        parent::__construct($config);
    }

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'news_id' => null,
        'limit' => 3
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $options = [];
        $newsId = $this->config['news_id'];
        $news = $this->newsRepository->getOne($newsId, 'id');
        if ($newsId) {
                $options = [
                    'whereHas' => [
                        ['tags',
                            function ($query) use ($news, $newsId) {
                                return $query->where('news.id', '!=', $newsId)
                                    ->whereIn('name', $news->tags->pluck('name')->toArray());
                        }]
                    ]
                ];
            }

        $sort = [
            'field' => 'created_at',
            'direction' => 'DESC'
        ];

        $news = $this->newsRepository->getPaginationNews($options,2, $sort);

        return view('widgets.similar_news', compact('news'));
    }
}
