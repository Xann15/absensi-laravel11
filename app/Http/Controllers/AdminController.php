<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('user')->get();
        return view('admin.attendance.index', compact('attendances'));
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendance.edit', compact('attendance'));
    }

    public function updateAttendance(Request $request, Attendance $attendance)
    {
        $request->validate([
            'status' => 'required|in:present,absent,late,leave',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
        ]);

        // Konversi format waktu agar seragam
        $checkIn = $request->check_in ? date("H:i:s", strtotime($request->check_in)) : null;
        $checkOut = $request->check_out ? date("H:i:s", strtotime($request->check_out)) : null;

        // Paksa perubahan nilai dengan setAttribute()
        $attendance->setAttribute('status', $request->status);
        $attendance->setAttribute('check_in', $checkIn);
        $attendance->setAttribute('check_out', $checkOut);

        // Cek jika ada perubahan, baru save
        if ($attendance->isDirty()) {
            $attendance->save();
            return redirect()->route('admin.attendance')->with('success', 'Data absensi berhasil diperbarui.');
        }

        return back()->with('error', 'Tidak ada perubahan data yang disimpan.');
    }


    public function deleteAttendance(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->back()->with('success', 'Absensi berhasil dihapus.');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $user->update(['role' => $request->role]);
        return redirect()->back()->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
