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

