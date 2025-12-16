<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-serif font-bold text-nature-dark">Dashboard Admin</h1>
            <a href="{{ route('admin.create') }}" class="bg-nature-dark text-white px-4 py-2 rounded-lg hover:bg-nature-light hover:text-nature-dark transition">
                + Tambah Destinasi
            </a>
        </div>

        @if(session('status'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">{{ session('status') }}</div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 uppercase font-bold">
                        <tr>
                            <th class="px-6 py-3">Nama</th>
                            <th class="px-6 py-3">Provinsi</th>
                            <th class="px-6 py-3">Tipe</th>
                            <th class="px-6 py-3">Harga</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($destinations as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold">{{ $item->name }}</td>
                            <td class="px-6 py-4">{{ $item->province }}</td>
                            <td class="px-6 py-4">{{ $item->nature_type }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->price_estimate) }}</td>
                            <td class="px-6 py-4 flex justify-center space-x-2">
                                <a href="{{ route('admin.edit', $item->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <span class="text-gray-300">|</span>
                                <form action="{{ route('admin.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $destinations->links() }}
            </div>
        </div>
    </div>
</x-app-layout>