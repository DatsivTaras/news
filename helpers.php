<?php

/**
 * @param string $key
 * @param null|int $category
 *
 * @return mixed
 */
function getSetting(string $key, int $category = null)
{
    return (new \App\Repositories\SettingRepository())->getSetting($key, $category);
}

function getMetaData($pageMeta = [])
{
    $metaData = app(\App\Services\MetaServices::class)->getMetaData();

    return [
        'url' => !empty($pageMeta['url']) ? $pageMeta['url'] : request()->url(),
        'title' => !empty($pageMeta['title']) ? $pageMeta['title'] : $metaData['title'],
        'description' => !empty($pageMeta['description']) ? $pageMeta['description'] : $metaData['description'],
        'image' => !empty($pageMeta['image']) ? $pageMeta['image'] : $metaData['image'],
    ];
}

function getDates($date)
{
    $date = \Carbon\Carbon::parse($date);

    $day =  \App\Helpers\DateHelper::getDays()[$date->format('D')];
    $month =  \App\Helpers\DateHelper::getMonth()[$date->format('M')];

    return $date->format( $day . ', ' . 'd' . ' ' . $month . ' ' . 'Y, h:i');
}

