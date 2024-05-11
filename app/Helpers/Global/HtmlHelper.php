<?php

if (!function_exists('htmlLang')) {
    /**
     * @return string|array
     */
    function htmlLang(): string|array
    {
        return str_replace('_', '-', app()->getLocale());
    }
}

if (!function_exists('indexTable')) {
    /**
     * @param $currentPage
     * @param $perPage
     * @param $index
     *
     * @return string
     */
    function indexTable($currentPage, $perPage, $index): string
    {
        return ($currentPage * $perPage) - $perPage + $index + 1;
    }
}

if (!function_exists('handleSelected')) {
    /**
     * @param null $compareFirst
     * @param null $compareSecond
     *
     * @return string
     */
    function handleSelected($compareFirst = null, $compareSecond = null): string
    {
        $result = '';
        if($compareFirst && $compareSecond && ($compareFirst == $compareSecond)) {
            $result = 'selected';
        }

        return $result;
    }
}

if (! function_exists('formatCurrency')) {
    /**
     * @param      $currency
     * @param string $currencyUnit
     * @param bool $after
     *
     * @return int|string
     */
    function formatCurrency($currency, string $currencyUnit = '', bool $after = true): int|string
    {
        if (isset($currency) && $currency != '') {
            $format = number_format($currency, 0, ',', ',');
            if ($after && isset($format)) {
                return $format . $currencyUnit;
            }

            return isset($format) ? ($currencyUnit . $format) : 0;
        }

        return '';
    }
}

