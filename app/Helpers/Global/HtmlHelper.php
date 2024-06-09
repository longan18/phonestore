<?php
use Illuminate\Support\Facades\Route;

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
            $format = number_format($currency, 0, ',', '.');
            if ($after && isset($format)) {
                return $format . $currencyUnit;
            }

            return isset($format) ? ($currencyUnit . $format) : 0;
        }

        return '';
    }
}

if (! function_exists('currentRoute')) {
    /**
     * @param $routeName
     * @return bool
     */
    function currentRoute($namePrefix): bool
    {
        $routeName = Route::currentRouteName();
        $prefix = explode('.', $routeName)[0];

        if ($prefix == $namePrefix || $routeName == $namePrefix) {
            return true;
        }

        return false;
    }
}

if (!function_exists('shorten_numbers')) {
    /**
     * 1000 => 1K
     * 16000000 => 16M
     * 1234567890 => 1.2B
     *
     * @param $number
     * @return string
     */
    function shorten_numbers($number) {
        $units = ['', 'K', 'M', 'B', 'T'];
        $power = floor(log($number, 1000));
        return round($number / pow(1000, $power), 1) . $units[$power];
    }
}

