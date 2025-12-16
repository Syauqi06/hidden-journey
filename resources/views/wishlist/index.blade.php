<x-app-layout>
    <div class="bg-nature-cream min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center mb-12">
                <span class="text-4xl mb-2 block">❤️</span>
                <h1 class="text-3xl font-serif font-bold text-nature-dark">Koleksi Impian Saya</h1>
                <p class="text-gray-600 mt-2">Daftar tempat persembunyian yang ingin Anda kunjungi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($wishlists as $item)
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition group border border-gray-100 relative">
                        
                        <form action="{{ route('wishlist.toggle', $item->destination->id) }}" method="POST" class="absolute top-2 right-2 z-10">
                            @csrf
                            <button type="submit" class="bg-white/90 text-red-400 hover:text-red-600 p-2 rounded-full shadow-sm hover:bg-white transition" title="Hapus dari koleksi">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </form>

                        <a href="{{ route('destination.show', $item->destination->slug) }}" class="block h-48 overflow-hidden">
                            <img src="{{ Str::startsWith($item->destination->cover_image, 'http') ? $item->destination->cover_image : asset('storage/'.$item->destination->cover_image) }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </a>

                        <div class="p-5">
                            <div class="text-xs font-bold text-nature-light uppercase tracking-wider mb-1">
                                {{ $item->destination->nature_type }} • {{ $item->destination->province }}
                            </div>
                            <h3 class="font-serif font-bold text-lg text-nature-dark mb-2">
                                <a href="{{ route('destination.show', $item->destination->slug) }}">
                                    {{ $item->destination->name }}
                                </a>
                            </h3>
                            <div class="flex justify-between items-center border-t border-gray-50 pt-3 mt-3">
                                <span class="text-xs text-gray-500">Estimasi: Rp {{ number_format($item->destination->price_estimate, 0, ',', '.') }}</span>
                                <a href="{{ route('destination.show', $item->destination->slug) }}" class="text-sm font-bold text-nature-blue hover:underline">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
                        <div class="text-6xl mb-4 opacity-50">🍃</div>
                        <h3 class="text-xl font-bold text-gray-600 mb-2">Belum ada koleksi</h3>
                        <p class="text-gray-500 mb-6">Anda belum menyimpan destinasi manapun.</p>
                        <a href="{{ route('explore') }}" class="inline-block bg-nature-dark text-white px-6 py-3 rounded-xl font-bold hover:bg-nature-light hover:text-nature-dark transition shadow-lg">
                            Mulai Menjelajah
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{-- $wishlists->links() --}} </div>
        </div>
    </div>
</x-app-layout>