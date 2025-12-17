<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hidden Journey') }}</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-nature-cream text-nature-text">
    <div class="min-h-screen flex flex-col justify-between">
        
        <nav x-data="{ open: false }" class="bg-nature-dark text-white sticky top-0 z-50 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                                <img src="{{ asset('images/logo.png') }}" alt="Logo Hidden Journey" class="h-10 w-auto group-hover:opacity-90 transition">
                            
                            <span class="font-serif text-xl md:text-2xl font-bold tracking-wider text-white group-hover:text-nature-light transition">
                                Hidden Journey
                            </span>
                        </a>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:space-x-8">
                        <a href="{{ route('home') }}" class="hover:text-nature-light transition font-medium">Beranda</a>
                        <a href="{{ route('explore') }}" class="hover:text-nature-light transition font-medium">Jelajah Alam</a>
                        <a href="{{ route('wishlist.index') }}" class="flex items-center hover:text-nature-light transition font-medium gap-2">
                            <span>Koleksi Saya</span>
                        </a>

                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="bg-yellow-500/20 border border-yellow-500 text-yellow-400 px-3 py-1 rounded-lg hover:bg-yellow-500 hover:text-nature-dark transition font-bold text-sm">
                                    Dashboard
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                @csrf
                                <button type="submit" class="border border-white/30 px-4 py-1 rounded-full text-sm hover:bg-white hover:text-nature-dark transition">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="ml-4 border border-white px-5 py-2 rounded-full hover:bg-white hover:text-nature-dark transition font-medium text-sm">
                                Masuk
                            </a>
                        @endauth
                    </div>

                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="p-2 rounded-md text-gray-200 hover:text-white focus:outline-none">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-nature-dark border-t border-white/10 pb-4">
                <div class="pt-2 pb-3 space-y-1">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 bg-yellow-500/10 text-yellow-400 font-bold border-l-4 border-yellow-500">
                                Dashboard Admin
                            </a>
                        @endif
                    @endauth
                    <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-white/10">Beranda</a>
                    <a href="{{ route('explore') }}" class="block px-4 py-2 hover:bg-white/10">Jelajah</a>
                    <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 hover:bg-white/10">Koleksi Saya</a>
                    
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 hover:bg-white/10 text-red-200">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-white/10 font-bold text-nature-light">Masuk / Daftar</a>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="mb-auto">
            {{ $slot }}
        </main>

        <footer class="bg-nature-dark text-white/80 py-8 mt-12">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <h3 class="font-serif text-xl font-bold mb-2">Hidden Journey Nusantara</h3>
                <p class="text-sm font-light opacity-70 mb-4">Menemukan kedamaian di sudut tersembunyi Indonesia.</p>
                <div class="text-xs opacity-50 border-t border-white/10 pt-4">
                    &copy; 2025 Hidden Journey. Dibuat untuk pemulihan jiwa.
                </div>
            </div>
        </footer>
    </div>
</body>
</html>