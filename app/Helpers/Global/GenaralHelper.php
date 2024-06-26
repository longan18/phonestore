<?php

/**
 * Return the keyword when after format
 *
 * @return string
 */
if (!function_exists('escapeLike')) {
    /**
     * @param $keyword
     * @return array|string|string[]
     */
    function escapeLike($keyword)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $keyword);
    }
}

if (!function_exists('getCurrentDomain')) {
    function getCurrentDomain($param)
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        return $protocol . "://" . $host.$param;
    }
}
