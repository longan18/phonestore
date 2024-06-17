<?php

namespace App\Enums;

interface textMsg
{
    public function getText();
    public function getColor();
    public function getColorBtn();
}

enum StatusEnum: int implements textMsg
{
    case Publish = 2;

    case StopSelling = 1;


    public function getText()
    {
        return match($this) {
            StatusEnum::Publish => __('Đăng bán'),
            StatusEnum::StopSelling => __('Dừng bán'),
        };
    }

    public function getColor()
    {
        return match($this) {
            StatusEnum::Publish => 'text-success',
            StatusEnum::StopSelling => 'text-danger',
        };
    }

    public function getColorBtn()
    {
        return match($this) {
            StatusEnum::Publish => 'bg-lg-FFF-20Ef0D',
            StatusEnum::StopSelling => 'bg-lg-FFF-EF0D0D',
        };
    }
}
