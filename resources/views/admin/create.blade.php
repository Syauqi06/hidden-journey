<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-serif font-bold text-nature-dark mb-6">Tambah Destinasi Baru</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Ups! Ada kesalahan input:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nama Destinasi</label>
                        <input type="text" name="name" required class="w-full rounded-lg border-gray-300 focus:ring-nature-dark focus:border-nature-dark">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Provinsi</label>
                        <select name="province" class="w-full rounded-lg border-gray-300">
                            <option>Jawa Barat</option><option>Jawa Tengah</option><option>Jawa Timur</option><option>Bali</option><option>Yogyakarta</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tipe Alam</label>
                        <select name="nature_type" class="w-full rounded-lg border-gray-300">
                            <option>Pegunungan</option><option>Pantai</option><option>Air Terjun</option><option>Hutan</option><option>Danau</option>
                        </select>
                    </div>
                     <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Level Keramaian</label>
                        <select name="crowd_level" class="w-full rounded-lg border-gray-300">
                            <option>Sangat Sepi</option><option>Cukup Sepi</option><option>Sedang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Estimasi Harga (Angka)</label>
                        <input type="number" name="price_estimate" required class="w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kesulitan Akses</label>
                        <select name="access_difficulty" class="w-full rounded-lg border-gray-300">
                            <option>Mudah</option><option>Sedang</option><option>Menantang</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Singkat (Card)</label>
                    <textarea name="description" rows="2" required class="w-full rounded-lg border-gray-300"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Suasana (Healing Vibe)</label>
                    <textarea name="vibe_description" rows="4" required class="w-full rounded-lg border-gray-300"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Fasilitas (Pisahkan dengan koma)</label>
                    <input type="text" name="facilities_list" placeholder="Contoh: Toilet, Mushola, Parkir Luas" required class="w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Link Google Maps Embed</label>
                    <input type="text" name="location_url" required class="w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Kontak Pengelola (WA)</label>
                    <input type="text" name="contact_person" class="w-full rounded-lg border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Foto Cover</label>
                    <input type="file" name="cover_image" required class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <button type="submit" class="bg-nature-dark text-white px-6 py-3 rounded-xl font-bold hover:bg-nature-light hover:text-nature-dark transition w-full">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>
</x-app-layout>