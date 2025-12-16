<x-guest-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 h-screen">
        
        <div class="flex items-center justify-center bg-nature-cream p-8 order-2 md:order-1">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                
                <div class="text-center mb-8">
                    <a href="/" class="inline-flex items-center gap-2 justify-center">
                        <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto" alt="Logo">
                        <span class="text-3xl font-serif font-bold text-nature-dark">Bergabung</span>
                    </a>
                    <p class="text-gray-500 mt-2 text-sm">Mulai perjalanan penyembuhan jiwa Anda hari ini.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                        <input id="name" class="block w-full rounded-lg border-gray-300 focus:border-nature-dark focus:ring-nature-dark shadow-sm" 
                               type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input id="email" class="block w-full rounded-lg border-gray-300 focus:border-nature-dark focus:ring-nature-dark shadow-sm" 
                               type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                        <input id="password" class="block w-full rounded-lg border-gray-300 focus:border-nature-dark focus:ring-nature-dark shadow-sm" 
                               type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Password</label>
                        <input id="password_confirmation" class="block w-full rounded-lg border-gray-300 focus:border-nature-dark focus:ring-nature-dark shadow-sm" 
                               type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a class="text-sm text-gray-600 hover:text-nature-dark underline" href="{{ route('login') }}">
                            Sudah punya akun?
                        </a>

                        <button class="bg-nature-dark text-white px-6 py-2 rounded-lg font-bold hover:bg-nature-light hover:text-nature-dark transition shadow-md">
                            Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="hidden md:block relative bg-nature-dark order-1 md:order-2">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" 
                 class="w-full h-full object-cover opacity-60 mix-blend-overlay">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12 text-center">
                <h2 class="font-serif text-4xl font-bold mb-4">Langkah Awal</h2>
                <p class="text-lg font-light opacity-90">"Perjalanan seribu mil dimulai dengan satu langkah kecil."</p>
            </div>
        </div>

    </div>
</x-guest-layout>