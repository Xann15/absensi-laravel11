<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Absensi
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Absensi</h2>

        <form action="{{ route('admin.attendance.update', $attendance->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
        
            <!-- Status Kehadiran -->
            <label class="block">Status Kehadiran:</label>
            <select name="status" class="w-full p-2 border rounded">
                <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Hadir</option>
                <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absen</option>
                <option value="late" {{ $attendance->status == 'late' ? 'selected' : '' }}>Terlambat</option>
                <option value="leave" {{ $attendance->status == 'leave' ? 'selected' : '' }}>Izin</option>
            </select>
        
            <!-- Check-in -->
            <label class="block mt-2">Check-in (Opsional):</label>
            <input type="time" name="check_in" value="{{ old('check_in', $attendance->check_in) }}" class="w-full p-2 border rounded">
        
            <!-- Check-out -->
            <label class="block mt-2">Check-out (Opsional):</label>
            <input type="time" name="check_out" value="{{ old('check_out', $attendance->check_out) }}" class="w-full p-2 border rounded">
        
            <!-- Tombol Simpan -->
            <button type="submit" class="bg-blue-500 text-white p-2 mt-4 rounded">Perbarui</button>
        </form>
        
        
        
    </div>
</x-app-layout>
