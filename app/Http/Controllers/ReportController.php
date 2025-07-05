<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Models\DeliveryRegister;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportData = null;
        $drivers = User::all(); // For driver dropdown
        $settings = Setting::first();

        // Only process if we have a report type and scope
        if ($request->filled(['report_type', 'scope'])) {
            $reportType = $request->input('report_type');
            $scope = $request->input('scope');
            $driverId = $request->input('driver_id');

            // Set date range based on report type
            switch ($reportType) {
                case 'weekly':
                    // if ($request->filled('date')) {
                    //     $date = Carbon::parse($request->input('date'));
                    //     $start = $date->copy()->startOfWeek()->startOfDay();
                    //     $end = $date->copy()->endOfWeek()->endOfDay();
                    // }

                    if ($request->filled(['date_from', 'date_to'])) {
                        $start = Carbon::parse($request->input('date_from'))->startOfDay();
                        $end = Carbon::parse($request->input('date_to'))->endOfDay();
                    }


                    break;

                case 'monthly':
                    if ($request->filled(['date_from', 'date_to'])) {
                        $start = Carbon::parse($request->input('date_from'))->startOfDay();
                        $end = Carbon::parse($request->input('date_to'))->endOfDay();
                    }
                    break;

                case 'yearly':
                    if ($request->filled(['month_from', 'month_to'])) {
                        $start = Carbon::parse($request->input('month_from'))->startOfMonth()->startOfDay();
                        $end = Carbon::parse($request->input('month_to'))->endOfMonth()->endOfDay();
                    }
                    break;

                default:
                    $start = $end = null;
            }

            if (!empty($start) && !empty($end)) {
                $query = DeliveryRegister::with('user', 'vehicle')
                    ->whereBetween('time_in', [$start, $end]);

                // dd($query->get());

                // Filter for individual scope
                if ($scope === 'individual' && $driverId) {
                    $query->where('user_id', $driverId);
                }

                $reportData = $query->orderBy('time_in')->get();
            }
        }

        // return view('admin.reports', compact('reportData', 'drivers'));
        return view('admin.reports', compact('reportData', 'drivers', 'settings'));
    }

    public function download(Request $request)
    {
        $data = unserialize(base64_decode($request->input('data')));

        // $pdf = \PDF::loadView('admin.report-pdf', ['reportData' => $data]);
        $pdf = \PDF::loadView('admin.report-pdf', [
            'reportData' => $data,
            'settings' => Setting::first()
        ]);




        return $pdf->download('delivery_report.pdf');
    }


    public function downloadExcel(Request $request)
    {
        $rawData = unserialize(base64_decode($request->data));

        $formatted = collect($rawData)->map(function ($item, $index) {
            return [
                'S/N' => $index + 1,
                'Driver Name' => optional($item->user)->name ?? '-',
                'Date' => \Carbon\Carbon::parse($item->time_in)->format('M d, Y'),
                'Vehicle No' => optional($item->vehicle)->plate_number ?? '-',
                'Delivery Route' => optional($item->delivery_route)->route_name ?? '-',
                'Vehicle Temperature' => $item->vehicle_temprature ?? '-',
                'Product Temperature' => $item->product_temprature ?? '-',
                'Delivery Temperature' => $item->delivery_temprature ?? '-',
                'Incident Report' => $item->extra_note ?? '-',
                'Time In' => \Carbon\Carbon::parse($item->time_in)->format('H:i'),
                'Take Off Time' => $item->take_off_time ? \Carbon\Carbon::parse($item->take_off_time)->format('H:i') : '-',
                'Time Out' => $item->time_out ? \Carbon\Carbon::parse($item->time_out)->format('H:i') : 'Not completed',
                'Hours Worked' => $item->hours_worked ? "{$item->hours_worked} hours" : 'Pending',
            ];
        });

        return Excel::download(new ReportExport($formatted), 'delivery-report.xlsx');
    }
}
