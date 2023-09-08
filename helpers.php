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


function getDates($date)
{
    $date = \Carbon\Carbon::parse($date);

    $day =  \App\Helpers\DateHelper::getDays()[$date->format('D')];
    $month =  \App\Helpers\DateHelper::getMonth()[$date->format('M')];

    return $date->format( $day . ', ' . 'd' . ' ' . $month . ' ' . 'Y, h:i');
}

