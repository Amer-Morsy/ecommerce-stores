<?php

define('PAGINATION_COUNT', 1);

function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    return $filename;
}
