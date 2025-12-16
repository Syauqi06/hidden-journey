<x-app-layout>
    <div class="bg-nature-dark py-12 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-serif font-bold mb-2">Jelajah Alam Nusantara</h1>
            <p class="opacity-80">Temukan tempat persembunyianmu yang berikutnya.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row gap-8">
            
            <div class="w-full md:w-1/4">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="font-serif font-bold text-lg mb-4 text-nature-dark border-b pb-2">Filter Pencarian</h3>
                    
                    <form action="{{ route('explore') }}" method="GET">
                        @if(request('province')) <input type="hidden" name="province" value="{{ request('province') }}"> @endif
                        
                        <div class="space-y-6">
                            <div>
                                <label class="text-sm font-bold text-gray-600 block mb-2">Tipe Alam</label>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <label class="flex items-center"><input type="radio" name="nature_type" value="" class="mr-2 text-nature-dark focus:ring-nature-dark" {{ request('nature_type') == '' ? 'checked' : '' }}> Semua</label>
                                    <label class="flex items-center"><input type="radio" name="nature_type" value="Pegunungan" class="mr-2 text-nature-dark focus:ring-nature-dark" {{ request('nature_type') == 'Pegunungan' ? 'checked' : '' }}> Pegunungan</label>
                                    <label class="flex items-center"><input type="radio" name="nature_type" value="Pantai" class="mr-2 text-nature-dark focus:ring-nature-dark" {{ request('nature_type') == 'Pantai' ? 'checked' : '' }}> Pantai</label>
                                    <label class="flex items-center"><input type="radio" name="nature_type" value="Hutan" class="mr-2 text-nature-dark focus:ring-nature-dark" {{ request('nature_type') == 'Hutan' ? 'checked' : '' }}> Hutan</label>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-bold text-gray-600 block mb-2">Akses Jalan</label>
                                <select name="access_difficulty" class="w-full rounded-lg border-gray-300 text-sm focus:border-nature-dark focus:ring-0">
                                    <option value="">Semua Akses</option>
                                    <option value="Mudah" {{ request('access_difficulty') == 'Mudah' ? 'selected' : '' }}>Mudah (Mobil Masuk)</option>
                                    <option value="Menantang" {{ request('access_difficulty') == 'Menantang' ? 'selected' : '' }}>Menantang (Trekking)</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-bold text-gray-600 block mb-2">Budget Maksimal</label>
                                <input type="number" name="max_price" placeholder="Contoh: 50000" value="{{ request('max_price') }}" class="w-full rounded-lg border-gray-300 text-sm focus:border-nature-dark focus:ring-0">
                            </div>

                            <button type="submit" class="w-full bg-nature-dark text-white py-2 rounded-lg text-sm font-bold hover:bg-nature-light hover:text-nature-dark transition">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('explore') }}" class="block text-center text-xs text-gray-400 mt-2 hover:underline">Reset Filter</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-full md:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($destinations as $item)
                        <a href="{{ route('destination.show', $item->slug) }}" class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg transition">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ Str::startsWith($item->cover_image, 'http') ? $item->cover_image : asset('storage/'.$item->cover_image) }}">
                                <span class="absolute bottom-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded">
                                    {{ $item->crowd_level }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h3 class="font-serif font-bold text-lg text-gray-800 mb-1 truncate">{{ $item->name }}</h3>
                                <p class="text-xs text-gray-500 mb-3">{{ $item->province }}</p>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $item->description }}</p>
                                <div class="text-nature-blue font-medium text-sm">Lihat Detail →</div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-4xl mb-4">🍂</div>
                            <h3 class="font-serif text-xl font-bold text-gray-600">Tidak ditemukan</h3>
                            <p class="text-gray-500">Coba ubah filter pencarian Anda.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $destinations->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>