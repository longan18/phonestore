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
