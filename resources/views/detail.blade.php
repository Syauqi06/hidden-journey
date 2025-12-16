<x-app-layout>
    @if(session('status'))
        <div class="bg-nature-dark text-white text-center py-3 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="h-[50vh] md:h-[60vh] w-full overflow-hidden relative">
        <img src="{{ Str::startsWith($destination->cover_image, 'http') ? $destination->cover_image : asset('storage/'.$destination->cover_image) }}" class="w-full h-full object-cover">
        
        <div class="absolute inset-0 bg-gradient-to-t from-nature-dark/90 via-transparent to-transparent flex items-end">
            <div class="max-w-7xl mx-auto w-full px-4 pb-12">
                <div class="bg-white/10 backdrop-blur-sm inline-block px-3 py-1 rounded-full text-white/80 text-sm mb-4 border border-white/20">
                    {{ $destination->nature_type }} • {{ $destination->province }}
                </div>
                <h1 class="text-4xl md:text-6xl font-serif font-bold text-white mb-2 shadow-sm">{{ $destination->name }}</h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            
            <div class="md:col-span-2 space-y-10">
                
                <div>
                    <h2 class="font-serif text-2xl font-bold text-nature-dark mb-4 flex items-center gap-2">
                        <span>🍃</span> Suasana & Ketenangan
                    </h2>
                    <div class="prose prose-lg text-gray-700 leading-relaxed font-light">
                        {{ $destination->vibe_description }}
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-8"></div>

                <div>
                    <h3 class="font-bold text-lg text-gray-800 mb-4">Fasilitas Tersedia</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($destination->facilities_list as $facility)
                            <div class="flex items-center p-3 bg-white border border-gray-100 rounded-lg shadow-sm">
                                <svg class="w-5 h-5 text-nature-light mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="text-sm text-gray-600">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg text-gray-800 mb-4">Lokasi & Rute</h3>
                    <div class="bg-gray-200 rounded-xl overflow-hidden h-64 w-full relative">
                        <div class="flex items-center justify-center h-full text-gray-500">
                           <iframe src="{{ $destination->location_url }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="mt-4 bg-yellow-50 p-4 rounded-lg border border-yellow-100 flex gap-3">
                        <span class="text-xl">🚗</span>
                        <div>
                            <p class="font-bold text-sm text-gray-800">Aksesibilitas: {{ $destination->access_difficulty }}</p>
                            <p class="text-xs text-gray-600 mt-1">Pastikan kendaraan dalam kondisi prima. Cek cuaca sebelum berangkat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-xl sticky top-24 border border-gray-100">
                    
                    <div class="mb-6 border-b border-gray-100 pb-6">
                        <p class="text-gray-500 text-xs uppercase tracking-wide font-bold">Estimasi Biaya</p>
                        <div class="flex items-baseline gap-1 mt-1">
                            <span class="text-3xl font-serif font-bold text-nature-dark">Rp {{ number_format($destination->price_estimate, 0, ',', '.') }}</span>
                            <span class="text-gray-400 text-sm">/ orang</span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Keramaian</span>
                            <span class="font-bold text-gray-800">{{ $destination->crowd_level }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Jam Operasional</span>
                            <span class="font-bold text-gray-800">06:00 - 18:00</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="https://wa.me/{{ $destination->contact_person }}" target="_blank" class="block w-full bg-nature-dark text-white text-center py-3 rounded-xl font-bold hover:bg-nature-light hover:text-nature-dark transition shadow-lg">
                            📞 Hubungi Pengelola
                        </a>

                        @auth
                            <form action="{{ route('wishlist.toggle', $destination->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full py-3 rounded-xl font-bold border-2 transition flex justify-center items-center gap-2
                                    {{ $isWishlisted 
                                        ? 'bg-red-50 border-red-200 text-red-500 hover:bg-red-100' 
                                        : 'border-gray-200 text-gray-600 hover:border-nature-dark hover:text-nature-dark' }}">
                                    @if($isWishlisted)
                                        <span>❤️ Tersimpan</span>
                                    @else
                                        <span>🤍 Simpan ke Koleksi</span>
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center py-3 rounded-xl font-bold border-2 border-gray-200 text-gray-500 hover:border-nature-dark hover:text-nature-dark transition">
                                Login untuk Simpan
                            </a>
                        @endauth
                    </div>

                    <p class="text-[10px] text-center text-gray-400 mt-4 leading-tight">
                        Hidden Journey tidak melayani transaksi tiket. Hubungi kontak di atas untuk info terkini.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>