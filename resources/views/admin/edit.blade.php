<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-serif font-bold text-nature-dark">Edit Destinasi</h1>
                <p class="text-gray-500 mt-1">Memperbarui data: <span class="font-bold text-gray-800">{{ $destination->name }}</span></p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-gray-500 hover:text-nature-dark transition font-medium">
                <span>←</span> Batal & Kembali
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg mb-8 animate-pulse">
                <div class="flex">
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-red-800">Gagal memperbarui data:</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT') <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-nature-cream p-2 rounded-lg text-nature-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Informasi Utama</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Destinasi</label>
                        <input type="text" name="name" value="{{ old('name', $destination->name) }}" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Provinsi</label>
                        <select name="province" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                            @foreach(['Aceh','Sumatera Utara','Sumatera Barat','Riau','Jambi','Sumatera Selatan','Bengkulu','Lampung','Kep. Bangka Belitung','Kep. Riau','DKI Jakarta','Jawa Barat','Jawa Tengah','DI Yogyakarta','Jawa Timur','Banten','Bali','NTB','NTT','Kalimantan Barat','Kalimantan Tengah','Kalimantan Selatan','Kalimantan Timur','Kalimantan Utara','Sulawesi Utara','Sulawesi Tengah','Sulawesi Selatan','Sulawesi Tenggara','Gorontalo','Sulawesi Barat','Maluku','Maluku Utara','Papua','Papua Barat'] as $prov)
                                <option value="{{ $prov }}" {{ old('province', $destination->province) == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Alam</label>
                        <select name="nature_type" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                            @foreach(['Pegunungan', 'Pantai', 'Air Terjun', 'Hutan', 'Danau'] as $type)
                                <option value="{{ $type }}" {{ old('nature_type', $destination->nature_type) == $type ? 'selected' : '' }}>
                                    {{ $type == 'Pegunungan' ? '🏔️' : ($type == 'Pantai' ? '🌊' : ($type == 'Air Terjun' ? '💧' : ($type == 'Hutan' ? '🌲' : '🛶'))) }} {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Estimasi Biaya (Rp)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-3.5 text-gray-400 font-bold">Rp</span>
                            <input type="number" name="price_estimate" value="{{ old('price_estimate', $destination->price_estimate) }}" 
                                class="w-full rounded-xl border-gray-200 bg-gray-50 pl-12 pr-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tingkat Keramaian</label>
                        <select name="crowd_level" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                            @foreach(['Sangat Sepi', 'Cukup Sepi', 'Sedang'] as $crowd)
                                <option value="{{ $crowd }}" {{ old('crowd_level', $destination->crowd_level) == $crowd ? 'selected' : '' }}>
                                    {{ $crowd == 'Sangat Sepi' ? '🍃' : ($crowd == 'Cukup Sepi' ? '⛅' : '🚶') }} {{ $crowd }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="bg-nature-cream p-2 rounded-lg text-nature-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Detail & Cerita</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="2" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>{{ old('description', $destination->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Suasana (Healing Vibe)</label>
                        <textarea name="vibe_description" rows="5" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>{{ old('vibe_description', $destination->vibe_description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fasilitas (Pisahkan Koma)</label>
                            <input type="text" name="facilities_list" value="{{ old('facilities_list', $facilitiesString) }}" 
                                class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Kesulitan Akses</label>
                            <select name="access_difficulty" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200 cursor-pointer">
                                @foreach(['Mudah', 'Sedang', 'Menantang'] as $acc)
                                    <option value="{{ $acc }}" {{ old('access_difficulty', $destination->access_difficulty) == $acc ? 'selected' : '' }}>
                                        {{ $acc == 'Mudah' ? '🚗' : ($acc == 'Sedang' ? '🚶' : '🧗') }} {{ $acc }}
                                    </option>
                                @endforeach
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
                        <input type="text" name="location_url" value="{{ old('location_url', $destination->location_url) }}" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Kontak Pengelola (WhatsApp)</label>
                        <input type="text" name="contact_person" value="{{ old('contact_person', $destination->contact_person) }}" 
                            class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 focus:bg-white focus:border-nature-dark focus:ring-2 focus:ring-nature-dark/20 transition duration-200">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Foto Destinasi</label>
                        
                        <div class="flex flex-col md:flex-row gap-6 items-center">
                            <div class="w-full md:w-1/3">
                                <p class="text-xs text-gray-400 mb-2">Foto Saat Ini:</p>
                                <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm relative h-40">
                                    <img src="{{ Str::startsWith($destination->cover_image, 'http') ? $destination->cover_image : asset('storage/'.$destination->cover_image) }}" 
                                         class="w-full h-full object-cover" alt="Current Cover">
                                </div>
                            </div>

                            <div class="w-full md:w-2/3">
                                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 hover:bg-nature-cream/30 transition duration-300">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        <p class="mb-1 text-sm text-gray-500"><span class="font-bold">Klik untuk ganti foto</span> (Opsional)</p>
                                        <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah foto.</p>
                                    </div>
                                    <input id="dropzone-file" type="file" name="cover_image" class="hidden" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col-reverse md:flex-row justify-end gap-4 pt-4">
                <a href="{{ route('admin.dashboard') }}" class="px-6 py-4 rounded-xl font-bold text-gray-500 hover:bg-gray-100 transition text-center">
                    Batal
                </a>
                <button type="submit" class="bg-nature-dark text-white px-8 py-4 rounded-xl font-bold hover:bg-nature-light hover:text-nature-dark transition shadow-lg transform hover:-translate-y-1 w-full md:w-auto text-center">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>