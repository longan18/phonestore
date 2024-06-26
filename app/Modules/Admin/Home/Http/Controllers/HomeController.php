<?php

namespace App\Modules\Admin\Home\Http\Controllers;

use App\Enums\StatusPaymentOrder;
use App\Enums\StatusShippingOrder;
use App\Http\Controllers\Controller;
use App\Modules\OrderDetail\Models\OrderDetail;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $this->showChartYear();
        if ($request->query_total == 'month') {
            [$data, $title, $description] = $this->showChartMonth();
        } else if ($request->query_total == 'year') {
            [$data, $title, $description] = $this->showChartYear();
        } else {
            [$data, $title, $description] = $this->showChartWeek();
        }

        return view('admin.dashboard.index',
            compact('data', 'title','description')
        );
    }

    protected function showChartWeek()
    {
        $endOfWeek = Carbon::now();
        $startOfWeek = $endOfWeek->copy()->subWeeks(7)->startOfWeek();
        $period = CarbonPeriod::create($startOfWeek, '1 week', $endOfWeek);

        $data = [];
        foreach ($period as $key => $week) {
            $total = OrderDetail::where('status_shipping', StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value)
                ->where('status_payment', StatusPaymentOrder::ORDER_PAYMENT_PAID->value)
                ->whereBetween('created_at', [$week->startOfWeek()->toDateTimeString(), $week->endOfWeek()->toDateTimeString()])
                ->sum('price_total');

            $data[] = [
                'time' => $week->startOfWeek()->format('d/m/Y') . ' - ' . $week->endOfWeek()->format('d/m/Y'),
                'total' => $total,
            ];
        }

        $title = 'Doanh thu 8 tuần gần nhất';
        $description = 'Doanh thu 8 tuần gần nhất tính từ tuần hiện tại';

        return [$data, $title, $description];
    }

    protected function showChartMonth()
    {
        $now = Carbon::now();
        $threeMonthsAgo = $now->copy()->subMonths(3)->startOfMonth();

        $data = [];
        for ($i = 0; $i < 4; $i++) {
            $startOfMonth = $threeMonthsAgo->copy()->addMonths($i);
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            if ($startOfMonth->month == $now->month) {
                $endOfMonth = $now->copy()->startOfDay();
            }

            $total = OrderDetail::where('status_shipping', StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value)
                ->where('status_payment', StatusPaymentOrder::ORDER_PAYMENT_PAID->value)
                ->whereBetween('created_at', [$startOfMonth->startOfDay()->toDateTimeString(), $endOfMonth->endOfDay()->toDateTimeString()])
                ->sum('price_total');

            $data[] = [
                'time' => $startOfMonth->format('m/Y'),
                'total' => $total,
            ];
        }

        $title = 'Doanh thu 4 tháng gần nhất';
        $description = 'Doanh thu 4 tháng gần nhất tính từ tháng hiện tại';

        return [$data, $title, $description];
    }

    protected function showChartYear()
    {
        $now = Carbon::now();
        $threeYearsAgo = $now->copy()->subYears(3)->startOfYear();

        $data = [];
        for ($i = 0; $i < 4; $i++) {
            $startOfYear = $threeYearsAgo->copy()->addYears($i);
            $endOfYear = $startOfYear->copy()->endOfYear();

            if ($startOfYear->year == $now->year) {
                $endOfYear = $now->copy()->startOfDay();
            }

            $total = OrderDetail::where('status_shipping', StatusShippingOrder::ORDER_SHIP_SUCCESSFUL->value)
                ->where('status_payment', StatusPaymentOrder::ORDER_PAYMENT_PAID->value)
                ->whereBetween('created_at', [$startOfYear, $endOfYear])
                ->sum('price_total');

            $data[] = [
                'time' => $startOfYear->format('Y'),
                'total' => $total,
            ];
        }

        $title = 'Doanh thu 4 năm gần nhất';
        $description = 'Doanh thu 4 năm gần nhất tính từ năm hiện tại';

        return [$data, $title, $description];
    }
}
