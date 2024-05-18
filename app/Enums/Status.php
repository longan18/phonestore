<?php

namespace App\Enums;

interface textMsg
{
    public function getText();
}

enum Status: int implements textMsg
{
    case Publish = 3;

    case StopSelling = 1;


    public function getText()
    {
        return match($this) {
            Status::Publish => 'On sale',
            Status::StopSelling => 'Stop Selling',
        };
    }
}
