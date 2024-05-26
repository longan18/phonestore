<?php

namespace App\Enums;

interface textMsg
{
    public function getText();
    public function getColor();
    public function getColorBtn();
}

enum Status: int implements textMsg
{
    case Publish = 2;

    case StopSelling = 1;


    public function getText()
    {
        return match($this) {
            Status::Publish => __('Đăng bán'),
            Status::StopSelling => __('Dừng bán'),
        };
    }

    public function getColor()
    {
        return match($this) {
            Status::Publish => 'text-success',
            Status::StopSelling => 'text-danger',
        };
    }

    public function getColorBtn()
    {
        return match($this) {
            Status::Publish => 'bg-lg-FFF-20Ef0D',
            Status::StopSelling => 'bg-lg-FFF-EF0D0D',
        };
    }
}
