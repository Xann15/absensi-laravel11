<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::where('user_id', Auth::id())->get();
        return view('attendance.index', compact('attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:present,absent,late,leave',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
        ]);

        Attendance::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'status' => $request->status,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
    }
}
