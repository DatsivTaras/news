<?php

namespace App\Widgets;

use App\Repositories\NewsRepository;
use Arrilot\Widgets\AbstractWidget;

class RecentNews extends AbstractWidget
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
        'category_id' => null,
        'limit' => 20
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $options = [];
        if ($categoryId = $this->config['category_id']) {
            $options = [
                'whereHas' => [
                    ['category',
                        function ($query) use ($categoryId) {
                            return $query->where('category_id', $categoryId);
                        }]
                ]
            ];
        }
        $sort = [
            'field' => 'created_at',
            'direction' => 'DESC'
        ];
        $lastNews = $this->newsRepository->table($options, $this->config['limit'], $sort);

        return view('widgets.recent_news', compact('lastNews'));
    }
}