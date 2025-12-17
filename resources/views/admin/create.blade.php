<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-serif font-bold text-nature-dark">Tambah Destinasi Baru</h1>
                <p class="text-gray-500 mt-1">Lengkapi data di bawah untuk menambahkan hidden gem baru.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-nature-dark transition font-medium">
                <span>←</span> Kembali ke Dashboard
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-8 animate-pulse">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pada inputan:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-nature-cream p-2 rounded-lg text-nature-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Informasi Utama</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Destinasi</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Danau Ranu Regulo" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Provinsi</label>
                        <select name="province" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                            @foreach(['Aceh','Sumatera Utara','Sumatera Barat','Riau','Jambi','Sumatera Selatan','Bengkulu','Lampung','Kep. Bangka Belitung','Kep. Riau','DKI Jakarta','Jawa Barat','Jawa Tengah','DI Yogyakarta','Jawa Timur','Banten','Bali','NTB','NTT','Kalimantan Barat','Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Sulawesi Tengah','Sulawesi Selatan','Sulawesi Tenggara','Gorontalo','Sulawesi Barat','Maluku','Maluku Utara','Papua','Papua Barat'] as $prov)
                                <option value="{{ $prov }}">{{ $prov }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Alam</label>
                        <select name="nature_type" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                            <option value="Pegunungan">🏔️ Pegunungan</option>
                            <option value="Pantai">🌊 Pantai</option>
                            <option value="Air Terjun">💧 Air Terjun</option>
                            <option value="Hutan">🌲 Hutan</option>
                            <option value="Danau">🛶 Danau</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Estimasi Biaya (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-400 font-bold">Rp</span>
                            <input type="number" name="price_estimate" value="{{ old('price_estimate') }}" placeholder="0" 
                                class="w-full rounded-xl border-gray-200 bg-gray-50 pl-12 pr-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat Keramaian</label>
                        <select name="crowd_level" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                            <option value="Sangat Sepi">🍃 Sangat Sepi</option>
                            <option value="Cukup Sepi">⛅ Cukup Sepi</option>
                            <option value="Sedang">🚶 Sedang</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-nature-cream p-2 rounded-lg text-nature-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Detail & Cerita</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat (Card)</label>
                        <p class="text-xs text-gray-400 mb-2">Ditampilkan di halaman depan. Maksimal 150 karakter.</p>
                        <textarea name="description" rows="2" placeholder="Tulis ringkasan singkat yang menarik..." 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Suasana (Healing Vibe)</label>
                        <p class="text-xs text-gray-400 mb-2">Jelaskan suasana, suara alam, dan perasaan tenang yang ditawarkan tempat ini.</p>
                        <textarea name="vibe_description" rows="5" placeholder="Contoh: Suara gemericik air yang konstan dan keteduhan pohon bambu membuat tempat ini sempurna untuk melarikan diri..." 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>{{ old('vibe_description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fasilitas (Pisahkan Koma)</label>
                            <input type="text" name="facilities_list" value="{{ old('facilities_list') }}" placeholder="Toilet, Mushola, Parkir, Warung" 
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kesulitan Akses</label>
                            <select name="access_difficulty" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                                <option value="Mudah">🚗 Mudah (Mobil Masuk)</option>
                                <option value="Sedang">🚶 Sedang (Jalan Kaki Sedikit)</option>
                                <option value="Menantang">🧗 Menantang (Trekking)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-nature-cream p-2 rounded-lg text-nature-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Media & Lokasi</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Link Google Maps Embed</label>
                        <input type="text" name="location_url" value="{{ old('location_url') }}" placeholder="https://www.google.com/maps/embed?..." 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                        <p class="text-[10px] text-gray-400 mt-1">Pastikan link diawali dengan http/https.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kontak Pengelola (WhatsApp)</label>
                        <input type="text" name="contact_person" value="{{ old('contact_person') }}" placeholder="628123456789" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Foto Utama Destinasi</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-nature-cream/30 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-bold">Klik untuk upload</span> atau drag gambar ke sini</p>
                                    <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="cover_image" class="hidden" required />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-nature-dark text-white px-8 py-4 rounded-xl font-bold hover:bg-nature-light hover:text-nature-dark transition shadow-lg transform hover:-translate-y-1 w-full md:w-auto text-center">
                    Simpan Destinasi Baru
                </button>
            </div>
        </form>
    </div>
</x-app-layout>