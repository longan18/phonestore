<?php

if (!function_exists('formatTime')) {
    /**
     * @param        $data
     * @param string $format_type
     *
     * @return string
     */
    function formatTime($data, string $format_type = "d - m - Y"): string
    {
        return date_format(date_create($data),$format_type);
    }
}

if (!function_exists('convertDateToDateTime')) {
    /**
     * @param        $data
     * @param string $formatCurrent
     *
     * @return string
     */
    function convertDateToDateTime($data, string $formatCurrent = 'd/m/Y'): string
    {
        return DateTime::createFromFormat($formatCurrent, $data)->format('Y-m-d H:i:s');
    }
}
