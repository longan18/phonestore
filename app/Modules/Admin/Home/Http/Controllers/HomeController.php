<?php

namespace App\Modules\Admin\Home\Http\Controllers;

use App\Enums\StatusOrder;
use App\Enums\StatusPaymentOrder;
use App\Enums\StatusShippingOrder;
use App\Http\Controllers\Controller;
use App\Modules\Client\Account\Models\User;
use App\Modules\OrderDetail\Models\OrderDetail;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $countUser = User::all()->count();
        $sumPriceTotalInMonth = $this->sumPriceTotalInMonth();
        $totalOrderDetailStatusOrderWarting = $this->totalOrderDetailStatusOrder(StatusOrder::ORDER_WRATING->value);
        $totalOrderDetailStatusOrderCancel = $this->totalOrderDetailStatusOrder(StatusOrder::ORDER_CANCEL->value);

        if ($request->query_total == 'month') {
            [$data, $title] = $this->totalPriceDateInMonth();
        } else {
            [$data, $title] = $this->totalPriceDateInYear();
        }

        return view('admin.dashboard.index',
            compact(
                'data',
                'title',
                'countUser',
                'sumPriceTotalInMonth',
                'totalOrderDetailStatusOrderWarting',
                'totalOrderDetailStatusOrderCancel'
            )
        );
    }

    private function sumPriceTotal($timeStart, $timeEnd)
    {
        return $this->queryRootOrderDetail($timeStart, $timeEnd)->sum('price_total');
    }

    private function queryRootOrderDetail($timeStart, $timeEnd)
    {
        return OrderDetail::where('status_shipping', StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value)
            ->where('status_payment', StatusPaymentOrder::ORDER_PAYMENT_PAID->value)
            ->whereBetween('created_at', [$timeStart, $timeEnd]);
    }

    private function sumPriceTotalInMonth()
    {
        $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();

        return $this->sumPriceTotal($startOfMonth, $endOfMonth);
    }

    private function totalOrderDetailStatusOrder($status)
    {
        return OrderDetail::where('status', $status)
            ->where('status_payment', StatusPaymentOrder::ORDER_PAYMENT_UNPAID->value)
            ->get()
            ->count();
    }

    private function totalPriceDateInYear()
    {
        $currentYear = Carbon::now()->year;

        $data = OrderDetail::select(
                DB::raw('MONTH(created_at) as time'),
                DB::raw('SUM(price_total) as total')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
            ->get();

        $dataIimeSql = $data->pluck('total', 'time')->toArray();
        $dataResult = [];
        for ($moth = 1; $moth <= 12; $moth++) {
            $fillMonth = str_pad($moth, 2, "0", STR_PAD_LEFT);
            $comparisonDate = "{$fillMonth}-{$currentYear}";

            if (array_key_exists($moth, $dataIimeSql)) {
                array_push($dataResult, [
                    'time' => $comparisonDate,
                    'total' => $dataIimeSql[$moth],
                ]);
            } else {
                array_push($dataResult, [
                    'time' => $comparisonDate,
                    'total' => 0,
                ]);
            }
        }

        $title = 'Doanh thu các tháng trong năm';
        return [$dataResult, $title];
    }

    private function totalPriceDateInMonth()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $daysInCurrentMonth = Carbon::now()->daysInMonth;

        $data = OrderDetail::select(
            DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as time"),
            DB::raw("SUM(price_total) as total")
        )
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('time')
            ->get();

        $dataIimeSql = $data->pluck('total', 'time')->toArray();
        $dataResult = [];
        for ($day = 1; $day <= $daysInCurrentMonth; $day++) {
            $fillDay = str_pad($day, 2, "0", STR_PAD_LEFT);
            $fillMonth = str_pad($currentMonth, 2, "0", STR_PAD_LEFT);
            $comparisonDate = "{$fillDay}-{$fillMonth}-{$currentYear}";

            if (array_key_exists($comparisonDate, $dataIimeSql)) {
                array_push($dataResult, [
                    'time' => $comparisonDate,
                    'total' => $dataIimeSql[$comparisonDate],
                ]);
            } else {
                array_push($dataResult, [
                    'time' => $comparisonDate,
                    'total' => 0,
                ]);
            }
        }

        $title = 'Doanh thu các ngày trong tháng';
        return [$dataResult, $title];
    }
}
