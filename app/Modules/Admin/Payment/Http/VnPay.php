<?php

namespace App\Modules\Admin\Payment\Http;

use App\Enums\StatusPaymentOrder;
use App\Http\Controllers\Controller;
use App\Modules\OrderDetail\Interfaces\OrderDetailInterface;
use Illuminate\Http\Request;

class VnPay extends Controller
{
    protected $orderDetail;
    public function __construct(OrderDetailInterface $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

    public function payment($order)
    {
        $inforVnPay = getInforVnpay();

        $vnp_Url = $inforVnPay['vnp_Url'];
        $vnp_Returnurl = $inforVnPay['vnp_Returnurl'];
        $vnp_TmnCode = $inforVnPay['vnp_TmnCode'];
        $vnp_HashSecret = $inforVnPay['vnp_HashSecret'];

        $vnp_TxnRef = $order->uuid;
        $vnp_OrderInfo = $order->note;
        $vnp_OrderType = '110000'; // Mã điện thoại và máy tính bảng
        $vnp_Amount = $order->price_total * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return [
            'code' => '00',
            'message' => 'success',
            'url' => $vnp_Url
        ];
    }

    public function vnpay_return(Request $request)
    {
        $dataRequest = $request->all();
        $inforVnPay = getInforVnpay();

        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $inforVnPay['vnp_HashSecret']);

        $orderDetail = $this->orderDetail->where('uuid', $dataRequest['vnp_TxnRef'])->first();

        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $orderDetail->update(['status_payment' => StatusPaymentOrder::ORDER_PAYMENT_PAID->value]);

                return to_route('client.order.index')->with(
                    ['data_vnpay' =>
                        [
                            'check_payment' => true,
                            'uuid' => $orderDetail->uuid,
                        ]
                    ],
                );
            }
            else {
                return to_route('client.order.index')->with(
                    ['data_vnpay' =>
                        [
                            'check_payment' => false,
                            'uuid' => $orderDetail->uuid
                        ]
                    ],
                );
            }
        } else {
            return to_route('client.order.index')->with(
                ['data_vnpay' =>
                    [
                        'check_payment' => false,
                        'uuid' => $orderDetail->uuid
                    ]
                ],
            );
        }
    }
}
