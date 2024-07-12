<?php

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('getFileUrl')) {
    /**
     * @param $disk
     * @param $url
     *
     * @return string
     */
    function getFileUrl($disk, $url): string
    {
        return Storage::disk($disk)->url($url);
    }
}

if (!function_exists('adminInfo')) {
    /**
     * @return Guard|StatefulGuard
     */
    function adminInfo(): Guard|StatefulGuard
    {
        return Auth::guard(GUARD_ADMIN);
    }
}

if (!function_exists('userInfo')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function userInfo()
    {
        return Auth::guard(GUARD_WEB)->user();
    }
}

if (!function_exists('generateSlug')) {
    /**
     * @param $data
     *
     * @return string
     */
    function generateSlug($data): string
    {
        return Str::slug($data . '-' . time());
    }
}

if (!function_exists('generateUUIDWithRandomString')) {
    /**
     * @param $data
     *
     * @return string
     */
    function generateUUIDWithRandomString(): string
    {
        $randomString = Str::random(5);
        $timestamp = Carbon::now()->format('YmdHis'); // Get the current timestamp in YYYY-MM-DD HH:II:SS format

        $uuid = $randomString . '-' . $timestamp;
        return $uuid;
    }
}
