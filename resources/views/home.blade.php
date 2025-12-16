<x-app-layout>
    <div class="relative min-h-screen flex items-center justify-center bg-nature-dark pt-24 pb-12 px-4 sm:px-0">
        
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=1600&auto=format&fit=crop" 
                 class="w-full h-full object-cover filter brightness-[0.60]" alt="Nature Background">
        </div>
        
        <div class="relative z-10 text-center w-full max-w-5xl mx-auto">
            <span class="inline-block py-1 px-3 border border-white/50 rounded-full text-white text-[10px] md:text-xs tracking-widest uppercase mb-4 backdrop-blur-sm">
                Slow Travel & Healing
            </span>
            
            <h1 class="text-3xl md:text-6xl font-serif font-bold text-white mb-4 md:mb-6 leading-tight drop-shadow-lg px-2">
                Temukan Ketenangan di <br class="hidden md:block"> Pelukan Alam Nusantara
            </h1>
            
            <p class="text-white/90 text-sm md:text-xl font-light mb-8 md:mb-10 max-w-2xl mx-auto px-4 leading-relaxed">
                Jauhi kebisingan kota. Kami mengkurasi destinasi tersembunyi yang hening untuk memulihkan energi dan jiwamu.
            </p>

            <div class="bg-white/95 backdrop-blur-md p-5 md:p-6 rounded-2xl shadow-2xl mx-4 md:mx-auto text-left relative z-20">
                <form action="{{ route('explore') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 items-center">
                    
                    <x-search-select 
                        label="Lokasi Tujuan" 
                        name="province" 
                        placeholder="Semua Provinsi" 
                        :options="$provinces" 
                    />

                    <x-search-select 
                        label="Suasana Alam" 
                        name="nature_type" 
                        placeholder="Semua Tipe" 
                        :options="['Pegunungan', 'Pantai', 'Hutan', 'Danau', 'Air Terjun']" 
                    />

                    <x-search-select 
                        label="Preferensi" 
                        name="crowd_level" 
                        placeholder="Tingkat Keramaian" 
                        :options="['Sangat Sepi', 'Cukup Sepi', 'Sedang']" 
                    />

                    <div class="flex items-end h-full">
                        <button type="submit" class="w-full bg-nature-dark text-white h-[52px] rounded-xl hover:bg-nature-light hover:text-nature-dark transition duration-300 font-bold shadow-lg text-sm md:text-base flex justify-center items-center gap-2 group">
                            <span class="group-hover:scale-110 transition duration-300">🔍</span> 
                            <span>Cari</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-16 md:py-20 bg-nature-cream">
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-4xl font-serif font-bold text-nature-dark mb-3">Rekomendasi Minggu Ini</h2>
            <div class="h-1 w-16 md:w-20 bg-nature-light mx-auto rounded-full"></div>
            <p class="mt-4 text-sm md:text-base text-gray-600 px-4">Destinasi dengan rating ketenangan tertinggi pilihan editor.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($recommendations as $item)
                <a href="{{ route('destination.show', $item->slug) }}" class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition duration-500 transform hover:-translate-y-1">
                    <div class="relative h-56 md:h-64 overflow-hidden">
                        <img src="{{ Str::startsWith($item->cover_image, 'http') ? $item->cover_image : asset('storage/'.$item->cover_image) }}" 
                             alt="{{ $item->name }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                        
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] md:text-xs font-bold text-nature-dark uppercase tracking-wider shadow-sm">
                            {{ $item->nature_type }}
                        </div>
                    </div>
                    
                    <div class="p-5 md:p-6">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs md:text-sm font-medium text-nature-blue">{{ $item->province }}</span>
                            <span class="flex items-center text-[10px] md:text-xs text-yellow-600 bg-yellow-50 px-2 py-1 rounded-md border border-yellow-100">
                                ⭐ {{ $item->crowd_level }}
                            </span>
                        </div>
                        <h3 class="text-lg md:text-xl font-serif font-bold text-gray-800 mb-2 group-hover:text-nature-dark transition line-clamp-1">{{ $item->name }}</h3>
                        <p class="text-gray-500 text-xs md:text-sm line-clamp-2 leading-relaxed mb-4">{{ $item->description }}</p>
                        
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs md:text-sm text-gray-400">Mulai Rp {{ number_format($item->price_estimate, 0, ',', '.') }}</span>
                            <span class="text-nature-dark font-medium text-xs md:text-sm flex items-center gap-1">
                                Detail <span class="group-hover:translate-x-1 transition">→</span>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        @if($recommendations->isEmpty())
            <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300 mx-4">
                <p class="text-gray-500 text-sm">Belum ada data rekomendasi.</p>
            </div>
        @endif
    </div>
</x-app-layout>