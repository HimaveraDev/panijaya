<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Pani Jaya - Kusen Berkualitas' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav class="bg-white sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Pani Jaya Logo" class="h-20 w-auto">
                    </a>
                </div>
                
                <div class="flex items-center space-x-8">
                    <div class="hidden md:flex md:space-x-8">
                        <a href="/" class="{{ request()->is('/') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Home</a>
                        <a href="/katalog" class="{{ request()->is('katalog*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Katalog</a>
                        <a href="/tentang" class="{{ request()->is('tentang*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Tentang Kami</a>
                        <a href="/artikel" class="{{ request()->is('artikel*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Artikel</a>
                        <a href="/pembayaran" class="{{ request()->is('pembayaran*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Metode Pembayaran</a>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center md:hidden">
                        <button type="button" class="text-gray-500 hover:text-gray-600">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-gray-800 pb-12">
                <div class="col-span-1 md:col-span-1">
                    <h3 class="text-2xl font-bold text-wood-500 mb-6">PANI JAYA</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Penyedia kusen, pintu, dan jendela berkualitas tinggi dengan material terbaik dan desain modern untuk hunian impian Anda.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Perusahaan</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="/tentang" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="/artikel" class="hover:text-white transition-colors">Artikel</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Katalog</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/katalog?kategori=kusen-kayu" class="hover:text-white transition-colors">Kusen Kayu</a></li>
                        <li><a href="/katalog?kategori=kusen-aluminium" class="hover:text-white transition-colors">Kusen Aluminium</a></li>
                        <li><a href="/katalog?kategori=pintu" class="hover:text-white transition-colors">Pintu Modern</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start">
                            <span class="mr-2 italic text-wood-500">Alamat:</span>
                            <span>Jl. Jend. Sudirman No. 123, Kota Bekasi</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 italic text-wood-500">WA:</span>
                            <span>+62 812 3456 789</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 italic text-wood-500">Email:</span>
                            <span>info@panijaya.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
                <p>&copy; 2026 Pani Jaya. All rights reserved.</p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/628123456789" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition-all transform hover:scale-110 z-50 flex items-center justify-center">
       <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
    </a>

</body>
</html>
