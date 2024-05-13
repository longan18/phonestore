<?php

return [

    'file_mimes_allow' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'png', 'jpg'],

    'file_mime_types_allow' => [
        'application/pdf',  //pdf
        'application/msword',   //doc
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  //docx
        'application/vnd.ms-excel', //xls
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',    //xlsx
        'application/vnd.ms-powerpoint',    //ppt
        'application/vnd.openxmlformats-officedocument.presentationml.presentation',    //pptx
        'image/png',    //png
        'image/jpeg'    //jpg
    ],

    'image_mimes_allow' => ['png', 'jpg', 'jpeg', 'gif'],

    'image_mime_types_allow' => [
        'image/png',    //png
        'image/jpeg',    //jpg, jpeg
        'image/gif',
    ],

    'file_max_size' => 1024 * 5,    //5mb

    'general_folder' => 'general/',
    'avatar_folder' => 'avatar/',
    'deal_folder' => 'deal/',
];
