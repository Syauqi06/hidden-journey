<x-guest-layout>
    <div class="grid grid-cols-1 md:grid-cols-2 h-screen">
        
        <div class="hidden md:block relative bg-nature-dark">
            <img src="https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" 
                 class="w-full h-full object-cover opacity-60 mix-blend-overlay">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12 text-center">
                <h2 class="font-serif text-4xl font-bold mb-4">Kembali ke Alam</h2>
                <p class="text-lg font-light opacity-90">Masuk untuk menyimpan daftar keinginan perjalanan penyembuhan jiwa Anda.</p>
            </div>
        </div>

        <div class="flex items-center justify-center bg-nature-cream p-8">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                
                <div class="text-center mb-8">
                    <a href="/" class="inline-flex items-center gap-2 justify-center">
                        <img src="{{ asset('images/logo.png') }}" class="h-12 w-auto" alt="Logo">
                        <span class="text-3xl font-serif font-bold text-nature-dark">Hidden Journey</span>
                    </a>
                    <h3 class="text-gray-500 mt-2 text-sm">Selamat datang kembali, Pengelana.</h3>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input id="email" class="block w-full rounded-lg border-gray-300 focus:border-nature-dark focus:ring-nature-dark shadow-sm" 
                               type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                        <input id="password" class="block w-full rounded-lg border-gray-300 focus:border-nature-dark focus:ring-nature-dark shadow-sm" 
                               type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-nature-dark shadow-sm focus:ring-nature-dark" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-400 hover:text-nature-dark underline" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif

                        <button class="bg-nature-dark text-white px-6 py-2 rounded-lg font-bold hover:bg-nature-light hover:text-nature-dark transition shadow-md">
                            Masuk
                        </button>
                    </div>

                    <div class="mt-6 text-center text-sm text-gray-500">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-nature-blue font-bold hover:underline">Daftar sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>