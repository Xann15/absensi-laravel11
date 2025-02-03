<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Absensi Hari Ini
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        @if(session('success'))
            <div class="bg-green-500 text-white p-2 mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('attendance.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            <label class="block">Status Kehadiran:</label>
            <select name="status" class="w-full p-2 border rounded">
                <option value="present">Hadir</option>
                <option value="absent">Absen</option>
                <option value="late">Terlambat</option>
                <option value="leave">Izin</option>
            </select>
            
            <label class="block mt-2">Check-in (Opsional):</label>
            <input type="time" name="check_in" class="w-full p-2 border rounded">

            <label class="block mt-2">Check-out (Opsional):</label>
            <input type="time" name="check_out" class="w-full p-2 border rounded">

            <button type="submit" class="bg-blue-500 text-white p-2 mt-4 rounded">Simpan</button>
        </form>

        <h3 class="mt-6">Riwayat Absensi</h3>
        <table class="w-full mt-2 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Check-in</th>
                    <th class="p-2 border">Check-out</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td class="p-2 border">{{ $attendance->date }}</td>
                    <td class="p-2 border">{{ ucfirst($attendance->status) }}</td>
                    <td class="p-2 border">{{ $attendance->check_in ?? '-' }}</td>
                    <td class="p-2 border">{{ $attendance->check_out ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
