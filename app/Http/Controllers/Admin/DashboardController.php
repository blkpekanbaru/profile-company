<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Workshop;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDepartment = Department::count();
        $totalTraining = Workshop::count();
        // $totalComplaint = Complaint::where('status', 'pending')->count();

        // Data Dummy untuk Peserta (Jika belum ada tabelnya)
        $totalParticipants = 0;
        $totalComplaint = 0;

        return view('admin.dashboard.dashboards', compact(
            'totalDepartment',
            'totalTraining',
            'totalComplaint',
            'totalParticipants'
        ));
    }
}
