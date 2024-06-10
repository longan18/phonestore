<?php

if (!defined('GUARD_ADMIN')) define('GUARD_ADMIN', 'admin');
if (!defined('GUARD_WEB')) define('GUARD_WEB', 'web');
if (!defined('PAGE_RECORD')) define('PAGE_RECORD', 10);

if (!defined('CATEGORY_SAMRTPHONE')) define('CATEGORY_SAMRTPHONE', 1);

if (!defined('PUBLISH')) define('PUBLISH', 2);
if (!defined('STOP_SELLING')) define('STOP_SELLING', 1);

if(!defined('REGEX_PHONE')) define('REGEX_PHONE', '/^(0|\+84)(3[2-9]|5[568]|7[06-9]|8[1-689]|9[0-46-9])\d{7}$/');
