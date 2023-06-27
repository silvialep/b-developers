<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as DB;
use Carbon\Carbon;


class ChartJSController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $devLogged = $user->developer->id;

        // Messaggi
        $messages = Message::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month_name"))
            ->where('developer_id', $devLogged)
            ->whereYear('created_at', '>=', Carbon::now()->subMonths(12)->year)
            ->groupBy('month_name', 'created_at')
            ->orderBy('created_at', 'asc')
            ->pluck('count', 'month_name');

        $labels = $this->getPast12Months();
        $data = $this->populateData($labels, $messages);

        // Recensioni
        $reviews = Review::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month_name"))
            ->where('developer_id', $devLogged)
            ->whereYear('created_at', '>=', Carbon::now()->subMonths(12)->year)
            ->groupBy('month_name', 'created_at')
            ->orderBy('created_at', 'asc')
            ->pluck('count', 'month_name');

        $labelsReviews = $this->getPast12Months();
        $dataReviews = $this->populateData($labelsReviews, $reviews);

        return view('admin.statistics.chart', compact('labels', 'data', 'labelsReviews', 'dataReviews'));
    }

    private function getPast12Months()
    {
        $labels = [];
        $currentDate = Carbon::now();

        for ($i = 0; $i < 12; $i++) {
            $labels[] = $currentDate->format('m/Y');
            $currentDate->subMonth();
        }

        return array_reverse($labels);
    }

    private function populateData($labels, $values)
    {
        $data = [];

        foreach ($labels as $label) {
            if (isset($values[$label])) {
                $data[] = $values[$label];
            } else {
                $data[] = 0;
            }
        }

        return $data;
    }
}