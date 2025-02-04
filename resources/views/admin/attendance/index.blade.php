<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Absensi
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <h3 class="text-lg font-bold">Daftar Absensi</h3>

        <table class="w-full mt-2 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Check-in</th>
                    <th class="p-2 border">Check-out</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td class="p-2 border">{{ $attendance->user->name }}</td>
                    <td class="p-2 border">{{ $attendance->date }}</td>
                    <td class="p-2 border">{{ ucfirst($attendance->status) }}</td>
                    <td class="p-2 border">{{ $attendance->check_in ?? '-' }}</td>
                    <td class="p-2 border">{{ $attendance->check_out ?? '-' }}</td>
                    <td class="p-2 border d-flex bg-info">
                        <form action="{{ route('admin.attendance.delete', $attendance->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('admin.attendance.edit', $attendance->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Edit
                        </a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                event.target.submit();
            }
        }
    </script>
</x-app-layout>
