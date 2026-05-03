<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="google-site-verification" content="daReDEq_stIZ7Uvc53DcK8Zmiulnb5W1ljK7ZKXYhpQ" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- SEO Meta Tags Utama --}}
    <title>{{ $title ?? $siteSettings->site_name . ' - Kusen Kayu & Aluminium Berkualitas Bekasi' }}</title>
    <meta name="description" content="{{ $metaDescription ?? $siteSettings->hero_description ?? 'Penyedia kusen, pintu, jendela, & roster berkualitas tinggi dengan material terbaik dan desain modern untuk hunian impian Anda di Bekasi dan sekitarnya.' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'kusen kayu, kusen aluminium, pintu kayu, jendela kayu, roster, kusen bekasi, pani jaya, jual kusen murah, pengrajin kayu' }}">
    <meta name="author" content="{{ $siteSettings->site_name }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Facebook / WhatsApp (Agar bagus saat link di-share) --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title ?? $siteSettings->site_name }}">
    <meta property="og:description" content="{{ $metaDescription ?? $siteSettings->hero_description ?? 'Penyedia kusen, pintu, dan jendela berkualitas tinggi.' }}">
    <meta property="og:image" content="{{ $metaImage ?? $siteSettings->hero_image_url }}">

    {{-- Twitter --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $title ?? $siteSettings->site_name }}">
    <meta property="twitter:description" content="{{ $metaDescription ?? $siteSettings->hero_description ?? 'Penyedia kusen, pintu, dan jendela berkualitas tinggi.' }}">
    <meta property="twitter:image" content="{{ $metaImage ?? $siteSettings->hero_image_url }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 overflow-x-hidden">

    <!-- Navbar -->
    <nav x-data="{ mobileMenuOpen: false }" class="bg-white sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-3">
                        <img src="{{ $siteSettings->logo_url }}" alt="{{ $siteSettings->site_name }} Logo" style="height: {{ $siteSettings->logo_height ?? 20 }}px; width: auto;">
                        <span class="font-bold text-xl text-wood-6 00 tracking-tight">{{ $siteSettings->site_name }}</span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-8">
                    <div class="hidden md:flex md:space-x-8">
                        <a href="/" class="{{ request()->is('/') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Home</a>
                        <a href="/katalog" class="{{ request()->is('katalog*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Katalog</a>
                        <a href="/portofolio" class="{{ request()->is('portofolio*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Portofolio</a>
                        <a href="/tentang" class="{{ request()->is('tentang*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Tentang Kami</a>
                        <a href="/artikel" class="{{ request()->is('artikel*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Artikel</a>
                        <a href="/pembayaran" class="{{ request()->is('pembayaran*') ? 'text-black font-semibold' : 'text-gray-500' }} hover:text-black text-sm font-medium transition-colors">Metode Pembayaran</a>
                    </div>
                    
                    <!-- Mobile Menu Button -->
                    <div class="flex items-center md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-gray-500 hover:text-wood-600 transition-colors p-2 rounded-lg hover:bg-gray-50">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Container -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-gray-50 bg-white">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="/" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->is('/') ? 'bg-wood-50 text-wood-600' : 'text-gray-600 hover:bg-gray-50' }}">Home</a>
                <a href="/katalog" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->is('katalog*') ? 'bg-wood-50 text-wood-600' : 'text-gray-600 hover:bg-gray-50' }}">Katalog</a>
                <a href="/portofolio" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->is('portofolio*') ? 'bg-wood-50 text-wood-600' : 'text-gray-600 hover:bg-gray-50' }}">Portofolio</a>
                <a href="/tentang" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->is('tentang*') ? 'bg-wood-50 text-wood-600' : 'text-gray-600 hover:bg-gray-50' }}">Tentang Kami</a>
                <a href="/artikel" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->is('artikel*') ? 'bg-wood-50 text-wood-600' : 'text-gray-600 hover:bg-gray-50' }}">Artikel</a>
                <a href="/pembayaran" class="block px-4 py-3 rounded-xl text-base font-medium {{ request()->is('pembayaran*') ? 'bg-wood-50 text-wood-600' : 'text-gray-600 hover:bg-gray-50' }}">Metode Pembayaran</a>
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
                    <h3 class="text-2xl font-bold text-wood-500 mb-6">{{ $siteSettings->site_name }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Penyedia kusen, pintu, jendela, & roster berkualitas tinggi dengan material terbaik dan desain modern untuk hunian impian Anda.
                    </p>
                    <div class="flex items-center space-x-4">
                        @if(isset($siteSettings->marketplace_links['shopee']))
                        <a href="{{ $siteSettings->marketplace_links['shopee'] }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-sm">
                            <img src="https://img.icons8.com/color/480/shopee.png" class="w-8 h-8 object-contain" alt="Shopee">
                        </a>
                        @endif
                        @if(isset($siteSettings->marketplace_links['tokopedia']))
                        <a href="{{ $siteSettings->marketplace_links['tokopedia'] }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-sm">
                            <img src="https://www.freepnglogos.com/uploads/logo-tokopedia-png/berita-tokopedia-info-berita-terbaru-tokopedia-6.png" class="w-8 h-8 object-contain" alt="Tokopedia">
                        </a>
                        @endif
                        @if(isset($siteSettings->marketplace_links['tiktok']))
                        <a href="{{ $siteSettings->marketplace_links['tiktok'] }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-sm">
                            <img src="https://img.icons8.com/color/480/tiktok--v1.png" class="w-8 h-8 object-contain" alt="TikTok Shop">
                        </a>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-6">Perusahaan</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="/tentang" class="hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="/artikel" class="hover:text-white transition-colors">Artikel</a></li>
                    </ul>
                </div>

                <!-- <div>
                    <h4 class="text-lg font-semibold mb-6">Katalog</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li><a href="/katalog?kategori=kusen-kayu" class="hover:text-white transition-colors">Kusen Kayu</a></li>
                        <li><a href="/katalog?kategori=kusen-aluminium" class="hover:text-white transition-colors">Kusen Aluminium</a></li>
                        <li><a href="/katalog?kategori=pintu" class="hover:text-white transition-colors">Pintu Modern</a></li>
                    </ul>
                </div> -->

                <div>
                    <h4 class="text-lg font-semibold mb-6">Kontak</h4>
                    <ul class="space-y-4 text-gray-400 text-sm">
                        <li class="flex items-start">
                            <span class="mr-2 italic text-wood-500">Alamat:</span>
                            <span>{{ $siteSettings->address }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 italic text-wood-500">WA:</span>
                            <span>{{ $siteSettings->whatsapp_number }}</span>
                        </li>
                        <li class="flex items-center">
                            <span class="mr-2 italic text-wood-500">Email:</span>
                            <span>{{ $siteSettings->email }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
                <p>&copy; {{ date('Y') }} {{ $siteSettings->footer_text ?? ($siteSettings->site_name . '. All rights reserved.') }}</p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp_number) }}" target="_blank" class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-2xl hover:bg-green-600 transition-all transform hover:scale-110 z-50 flex items-center justify-center">
       <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
    </a>

    {{-- Per-page scripts slot (Alpine.js injected here on pages that need it) --}}
    @stack('scripts')

</body>
</html>

