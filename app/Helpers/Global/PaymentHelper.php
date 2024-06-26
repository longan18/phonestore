<?php

if (!function_exists('getInforVnpay')) {
    function getInforVnpay()
    {
        return [
            'vnp_Url' => "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html",
            'vnp_Returnurl' => getCurrentDomain('/vnpay/return'),
            'vnp_TmnCode' => "TQ8DAAH3",
            'vnp_HashSecret' => "V7KHYWOI8WKZZUIR9AGO2UKYWWP0R1CC",
        ];
    }
}
