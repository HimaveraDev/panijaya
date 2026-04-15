@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[85vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('build/assets/wall1.png') }}" class="w-full h-full object-cover" alt="Modern House">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-2xl text-white">
                <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-6">
                    Kusen Berkualitas untuk <span class="text-wood-400">Hunian Modern</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 leading-relaxed">
                    Hadirkan keindahan dan ketahanan pada rumah Anda dengan pilihan kusen, pintu, dan jendela premium dari Pani Jaya. Kami mengutamakan detail dan kualitas material terbaik.
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="/katalog" class="px-8 py-4 bg-wood-600 hover:bg-wood-700 text-white font-semibold rounded-full text-center transition-all transform hover:scale-105">Lihat Produk</a>
                    <a href="/tentang" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 font-semibold rounded-full text-center transition-all">Selengkapnya</a>
                </div>
            </div>
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
                    @php
                        $imagePath = $category->image;
                        if ($imagePath && !Str::startsWith($imagePath, ['http', 'build/', 'images/'])) {
                            $imagePath = asset('storage/' . $imagePath);
                        } elseif ($imagePath) {
                            $imagePath = asset($imagePath);
                        }
                        // Fallback image if both DB and asset are missing
                        $imagePath = $imagePath ?: 'https://images.unsplash.com/photo-1541824232763-d11283d47443?auto=format&fit=crop&w=800&q=80';
                    @endphp
                    <img src="{{ $imagePath }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $category->name }}">
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
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">Mengapa Memilih Pani Jaya?</h2>
                    
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-wood-100 p-3 rounded-lg text-wood-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold mb-2">Material Berkualitas</h4>
                                <p class="text-gray-600">Kami hanya menggunakan kayu pilihan (Jati, Mahoni, Meranti) dan aluminium premium yang tahan lama serta estetik.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-wood-100 p-3 rounded-lg text-wood-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold mb-2">Custom Desain</h4>
                                <p class="text-gray-600">Sesuaikan ukuran dan model kusen, pintu, atau jendela Anda sesuai dengan selera dan kebutuhan arsitektur rumah.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-wood-100 p-3 rounded-lg text-wood-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V15m0 1v-8m0 0h.01"></path></svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-xl font-semibold mb-2">Harga Kompetitif</h4>
                                <p class="text-gray-600">Kualitas mewah tidak harus mahal. Kami menawarkan harga terbaik langsung dari workshop penyedia.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2 relative">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" class="rounded-3xl shadow-2xl relative z-10" alt="Work Process">
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
                        @php
                            $prodImg = $product->image;
                            if ($prodImg && !Str::startsWith($prodImg, ['http', 'build/', 'images/'])) {
                                $prodImg = asset('storage/' . $prodImg);
                            } else {
                                $prodImg = $prodImg ? asset($prodImg) : 'https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                            }
                        @endphp
                        <img src="{{ $prodImg }}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="{{ $product->name }}">
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
            <a href="https://wa.me/628123456789" class="inline-flex items-center px-10 py-5 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full text-lg shadow-xl transition-all transform hover:scale-105">
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
                        @php
                            $thumb = $article->thumbnail;
                            if ($thumb && !Str::startsWith($thumb, ['http', 'build/', 'images/'])) {
                                $thumb = asset('storage/' . $thumb);
                            } else {
                                $thumb = $thumb ? asset($thumb) : 'https://images.unsplash.com/photo-1588644972368-d1e5927d9220?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                            }
                        @endphp
                        <img src="{{ $thumb }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="{{ $article->title }}">
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
