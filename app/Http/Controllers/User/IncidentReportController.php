<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IncidentReport;

class IncidentReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hazardType' => 'required|string',
            'description' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $report = new IncidentReport();
        $report->userId = auth()->check() ? auth()->id() : 0; // Use auth ID if logged in
        $report->hazardType = $request->hazardType;
        $report->description = $request->description;
        $report->lat = $request->latitude;
        $report->lng = $request->longitude;
        $report->dateSubmitted = now();
        $report->status = 'Processing';
        $report->save();

        return response()->json([
            'message' => 'Incident Report Submitted Successfully!',
            'report' => $report
        ]);
    }

    public function myReports()
    {
        $reports = IncidentReport::where('userId', auth()->id())
            ->orderBy('dateSubmitted', 'desc')
            ->get();

        return response()->json($reports);
    }
}

    

