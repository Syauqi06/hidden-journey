<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-2xl font-serif font-bold text-nature-dark mb-6">Edit: {{ $destination->name }}</h1>

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100">
            <form action="{{ route('admin.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Destinasi</label>
                    <input type="text" name="name" value="{{ $destination->name }}" required class="w-full rounded-lg border-gray-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Provinsi</label>
                        <select name="province" class="w-full rounded-lg border-gray-300">
                            @foreach(['Jawa Barat','Jawa Tengah','Jawa Timur','Bali','Yogyakarta'] as $prov)
                                <option value="{{ $prov }}" {{ $destination->province == $prov ? 'selected' : '' }}>{{ $prov }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tipe Alam</label>
                        <select name="nature_type" class="w-full rounded-lg border-gray-300">
                            @foreach(['Pegunungan','Pantai','Air Terjun','Hutan','Danau'] as $type)
                                <option value="{{ $type }}" {{ $destination->nature_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                     <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Level Keramaian</label>
                        <select name="crowd_level" class="w-full rounded-lg border-gray-300">
                             @foreach(['Sangat Sepi','Cukup Sepi','Sedang'] as $crowd)
                                <option value="{{ $crowd }}" {{ $destination->crowd_level == $crowd ? 'selected' : '' }}>{{ $crowd }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Estimasi Harga</label>
                        <input type="number" name="price_estimate" value="{{ $destination->price_estimate }}" required class="w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kesulitan Akses</label>
                        <select name="access_difficulty" class="w-full rounded-lg border-gray-300">
                            @foreach(['Mudah','Sedang','Menantang'] as $acc)
                                <option value="{{ $acc }}" {{ $destination->access_difficulty == $acc ? 'selected' : '' }}>{{ $acc }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" required class="w-full rounded-lg border-gray-300">{{ $destination->description }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi Suasana</label>
                    <textarea name="vibe_description" rows="4" required class="w-full rounded-lg border-gray-300">{{ $destination->vibe_description }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Fasilitas (Pisahkan dengan koma)</label>
                    <input type="text" name="facilities_list" value="{{ $facilitiesString }}" class="w-full rounded-lg border-gray-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Link Maps Embed</label>
                        <input type="text" name="location_url" value="{{ $destination->location_url }}" class="w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Kontak (WA)</label>
                        <input type="text" name="contact_person" value="{{ $destination->contact_person }}" class="w-full rounded-lg border-gray-300">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Ganti Foto (Kosongkan jika tidak ingin ganti)</label>
                    <input type="file" name="cover_image" class="w-full border border-gray-300 rounded-lg p-2">
                    <p class="text-xs text-gray-500 mt-1">Foto saat ini: {{ $destination->cover_image }}</p>
                </div>

                <button type="submit" class="bg-nature-dark text-white px-6 py-3 rounded-xl font-bold hover:bg-nature-light hover:text-nature-dark transition w-full">
                    Update Data
                </button>
            </form>
        </div>
    </div>
</x-app-layout>