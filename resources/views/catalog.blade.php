@extends('layouts.app')

@section('content')
    <!-- Header -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Katalog Produk</h1>
            <p class="text-gray-400">Temukan berbagai pilihan kusen, pintu, dan jendela untuk kebutuhan konstruksi Anda.</p>
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">
                
                <!-- Sidebar Filters -->
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 sticky top-28">
                        <h3 class="text-lg font-bold mb-6">Filter Kategori</h3>
                        <div class="space-y-3">
                            <a href="/katalog" class="block px-4 py-2 rounded-lg {{ !request('kategori') ? 'bg-wood-600 text-white font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                Semua Produk
                            </a>
                            @foreach($categories as $category)
                            <a href="/katalog?kategori={{ $category->slug }}" class="block px-4 py-2 rounded-lg {{ request('kategori') == $category->slug ? 'bg-wood-600 text-white font-bold' : 'text-gray-600 hover:bg-gray-50' }}">
                                {{ $category->name }}
                            </a>
                            @endforeach
                        </div>

                        <div class="mt-12 pt-8 border-t border-gray-100">
                            <h3 class="text-lg font-bold mb-6">Cari Produk</h3>
                            <form action="/katalog" method="GET">
                                <div class="relative">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama produk..." class="w-full pl-4 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-wood-500 focus:border-wood-500 text-sm">
                                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="w-full lg:w-3/4">
                    @if($products->isEmpty())
                        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-200">
                            <p class="text-gray-500">Produk tidak ditemukan.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($products as $product)
                            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-300">
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
                                    @if($product->is_featured)
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-wood-600 text-white text-[10px] px-2 py-1 rounded uppercase tracking-widest font-bold">Featured</span>
                                    </div>
                                    @endif
                                </div>
                                <div class="p-6">
                                    <p class="text-xs text-wood-600 font-bold uppercase tracking-wider mb-2">{{ $product->category->name }}</p>
                                    <h3 class="text-lg font-bold text-gray-900 mb-4 h-14 line-clamp-2">{{ $product->name }}</h3>
                                    <a href="/katalog/{{ $product->slug }}" class="block w-full text-center py-3 bg-gray-900 border border-gray-900 text-white hover:bg-wood-600 hover:border-wood-600 font-semibold rounded-xl transition-all">Detail Produk</a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-16">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
