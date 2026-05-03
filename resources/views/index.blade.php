@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[85vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $siteSettings->hero_image_url }}" class="w-full h-full object-cover" alt="Modern House">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-6">
                    {!! $siteSettings->hero_title !!}
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 leading-relaxed">
                    {{ $siteSettings->hero_description }}
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/katalog" class="px-8 py-4 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-full text-center transition-all transform hover:scale-105">Lihat Produk</a>
                    <a href="/tentang" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 font-semibold rounded-full text-center transition-all">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Marketplace Section -->
    @if($siteSettings->hasMarketplace())
    <section class="py-12 bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Belanja Lebih Mudah di Marketplace Favorit Anda</h2>
                <p class="text-gray-500 text-sm">Temukan produk kami di berbagai platform marketplace terpercaya</p>
            </div>
            <div class="flex flex-wrap justify-center gap-6">
                @if(isset($siteSettings->marketplace_links['shopee']))
                <a href="{{ $siteSettings->marketplace_links['shopee'] }}" target="_blank" rel="noopener" class="flex items-center px-8 py-4 bg-white border-2 border-orange-100 hover:border-orange-500 rounded-xl shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1 group">
                    <div class="w-14 h-14 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center mr-4 group-hover:bg-orange-100 transition-colors">
                        <img src="https://img.icons8.com/color/480/shopee.png" class="w-10 h-10 object-contain" alt="Shopee">
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Official Store</p>
                        <p class="text-lg font-bold text-gray-900 group-hover:text-orange-500 transition-colors">Shopee</p>
                    </div>
                </a>
                @endif
                
                @if(isset($siteSettings->marketplace_links['tokopedia']))
                <a href="{{ $siteSettings->marketplace_links['tokopedia'] }}" target="_blank" rel="noopener" class="flex items-center px-8 py-4 bg-white border-2 border-green-100 hover:border-green-500 rounded-xl shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1 group">
                    <div class="w-14 h-14 bg-green-50 text-green-500 rounded-full flex items-center justify-center mr-4 group-hover:bg-green-100 transition-colors">
                        <img src="https://www.freepnglogos.com/uploads/logo-tokopedia-png/berita-tokopedia-info-berita-terbaru-tokopedia-6.png" class="w-10 h-10 object-contain" alt="Tokopedia">
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Official Store</p>
                        <p class="text-lg font-bold text-gray-900 group-hover:text-green-500 transition-colors">Tokopedia</p>
                    </div>
                </a>
                @endif

                @if(isset($siteSettings->marketplace_links['tiktok']))
                <a href="{{ $siteSettings->marketplace_links['tiktok'] }}" target="_blank" rel="noopener" class="flex items-center px-8 py-4 bg-white border-2 border-gray-200 hover:border-black rounded-xl shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1 group">
                    <div class="w-14 h-14 bg-gray-50 text-gray-900 rounded-full flex items-center justify-center mr-4 group-hover:bg-gray-200 transition-colors">
                        <img src="https://img.icons8.com/color/480/tiktok--v1.png" class="w-10 h-10 object-contain" alt="TikTok Shop">
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-widest font-bold mb-1">Official Store</p>
                        <p class="text-lg font-bold text-gray-900 group-hover:text-black transition-colors">TikTok Shop</p>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Testimoni Section -->
    <section class="py-16 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <div class="w-16 h-1 bg-wood-600 mx-auto rounded-full"></div>
            </div>

            @if($testimonials->count() > 0)
            <div x-data="{ 
                activeSlide: 0, 
                slides: {{ $testimonials->count() }},
                perPage: window.innerWidth > 1024 ? 4 : (window.innerWidth > 768 ? 3 : (window.innerWidth > 640 ? 2 : 1)),
                next() { if(this.activeSlide < this.slides - this.perPage) this.activeSlide++; else this.activeSlide = 0; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; else this.activeSlide = this.slides - this.perPage; }
            }" x-init="window.addEventListener('resize', () => { perPage = window.innerWidth > 1024 ? 4 : (window.innerWidth > 768 ? 3 : (window.innerWidth > 640 ? 2 : 1)) })" class="relative">
                
                <!-- Carousel Track -->
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" :style="'transform: translateX(-' + (activeSlide * (100 / perPage)) + '%)'">
                        @foreach($testimonials as $index => $testimonial)
                        <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 flex-shrink-0 px-2">
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col hover:shadow-md transition-all duration-300">
                                <!-- Photo Landscape (Flexible) -->
                                <div class="w-full h-48 bg-gray-50 p-2">
                                    <img src="{{ $testimonial->image_url }}" class="w-full h-full object-contain rounded-lg" alt="{{ $testimonial->name }}">
                                </div>
                                
                                <!-- Content Below (Very compact) -->
                                <div class="p-4 flex flex-col flex-grow relative">
                                    <div class="flex text-yellow-400 mb-2">
                                        @for($i = 0; $i < $testimonial->rating; $i++)
                                            <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                        @endfor
                                    </div>
                                    
                                    <p class="text-gray-600 text-[0.8rem] leading-snug mb-3 flex-grow italic line-clamp-3">
                                        {{ $testimonial->content }}
                                    </p>
                                    
                                    <div class="mt-auto pt-3 border-t border-gray-50">
                                        <h4 class="text-xs font-bold text-gray-900 truncate">{{ $testimonial->name }}</h4>
                                        <p class="text-wood-600 text-[10px] font-medium truncate">{{ $testimonial->role ?? 'Pelanggan Setia' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex justify-center mt-10 space-x-3" x-show="slides > perPage">
                    <button @click="prev()" class="p-2.5 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-wood-600 hover:text-white transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <div class="flex items-center space-x-1.5">
                        <template x-for="i in Math.max(0, slides - perPage + 1)" :key="i">
                            <button @click="activeSlide = i - 1" 
                                    :class="activeSlide === i - 1 ? 'bg-wood-600 w-6' : 'bg-gray-300 w-1.5'"
                                    class="h-1.5 rounded-full transition-all duration-300"></button>
                        </template>
                    </div>
                    <button @click="next()" class="p-2.5 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-wood-600 hover:text-white transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                <p class="text-gray-400 italic">Belum ada testimoni yang ditambahkan.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Kategori Produk Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Pilihan Produk Utama</h2>
                <div class="w-20 h-1.5 bg-wood-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($categories as $category)
                <a href="/katalog?kategori={{ $category->slug }}" class="group relative h-80 rounded-2xl overflow-hidden shadow-lg transition-all hover:-translate-y-2">
                    <img src="{{ $category->image_url }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $category->name }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h3 class="text-xl font-bold text-white">{{ $category->name }}</h3>
                        <p class="text-wood-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity">Lihat Koleksi &rarr;</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section class="py-24 bg-gray-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">{{ $siteSettings->features_title ?? 'Mengapa Memilih Pani Jaya?' }}</h2>
                    
                    <div class="space-y-8">
                        @if($siteSettings->feature_1_title)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-wood-100 p-3 rounded-lg text-wood-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold mb-2">{{ $siteSettings->feature_1_title }}</h4>
                                <p class="text-gray-600">{{ $siteSettings->feature_1_description }}</p>
                            </div>
                        </div>
                        @endif

                        @if($siteSettings->feature_2_title)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-wood-100 p-3 rounded-lg text-wood-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold mb-2">{{ $siteSettings->feature_2_title }}</h4>
                                <p class="text-gray-600">{{ $siteSettings->feature_2_description }}</p>
                            </div>
                        </div>
                        @endif

                        @if($siteSettings->feature_3_title)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-wood-100 p-3 rounded-lg text-wood-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V15m0 1v-8m0 0h.01"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold mb-2">{{ $siteSettings->feature_3_title }}</h4>
                                <p class="text-gray-600">{{ $siteSettings->feature_3_description }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2 relative">
                    <img src="{{ $siteSettings->features_image_url }}" class="rounded-3xl shadow-2xl relative z-10" alt="Features">
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-wood-600 rounded-2xl -z-0 opacity-20"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <h2 class="text-3xl font-bold mb-2">Produk Unggulan</h2>
                    <p class="text-gray-500">Koleksi terbaik yang paling diminati pelanggan kami.</p>
                </div>
                <a href="/katalog" class="text-wood-600 font-semibold hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="{{ $product->name }}">
                        <div class="absolute top-4 left-4">
                            <span class="bg-wood-600 text-white text-[10px] px-2 py-1 rounded uppercase tracking-widest font-bold">Featured</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-wood-600 font-bold uppercase tracking-wider mb-2">{{ $product->category->name }}</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">{{ $product->name }}</h3>
                        <a href="/katalog/{{ $product->slug }}" class="block w-full text-center py-3 bg-gray-50 hover:bg-wood-600 hover:text-white text-gray-900 font-semibold rounded-lg transition-colors">Detail Produk</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Consultation CTA -->
    <section class="py-20 bg-gray-900 overflow-hidden relative">
        <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
            <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Konsultasikan Kebutuhan Kusen & Pintu Anda</h2>
            <p class="text-gray-400 text-lg mb-10">Tanya jawab seputar material, ukuran, hingga perkiraan harga secara gratis melalui WhatsApp.</p>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp_number) }}" class="inline-flex items-center px-10 py-5 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full text-lg shadow-xl transition-all transform hover:scale-105">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                Hubungi via WhatsApp
            </a>
        </div>
        <!-- Abstract Decoration -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-wood-600 rounded-full blur-[120px] opacity-20"></div>
    </section>

    <!-- Articles Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4">Artikel Terbaru</h2>
                <div class="w-20 h-1.5 bg-wood-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($latestArticles as $article)
                <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group">
                    <div class="h-56 overflow-hidden">
                        <img src="{{ $article->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="{{ $article->title }}">
                    </div>
                    <div class="p-8">
                        <span class="text-wood-600 font-bold text-xs uppercase tracking-widest">{{ $article->published_at?->format('d M Y') }}</span>
                        <h3 class="text-xl font-bold mt-2 mb-4 group-hover:text-wood-600 transition-colors leading-tight">
                            <a href="/artikel/{{ $article->slug }}">{{ $article->title }}</a>
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-2 mb-6">{{ strip_tags($article->content) }}</p>
                        <a href="/artikel/{{ $article->slug }}" class="text-gray-900 font-bold text-sm border-b-2 border-wood-500 pb-1">Baca Selengkapnya</a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
