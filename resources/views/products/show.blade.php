@extends('layouts.app')

@section('content')
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-8 text-sm text-gray-500">
                <a href="/" class="hover:text-wood-600">Home</a>
                <span class="mx-2">/</span>
                <a href="/katalog" class="hover:text-wood-600">Katalog</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">{{ $product->name }}</span>
            </nav>

            <div class="flex flex-col lg:flex-row gap-16">
                <!-- Product Image -->
                <div class="w-full lg:w-1/2">
                    <div class="aspect-square rounded-3xl overflow-hidden bg-gray-100 shadow-inner">
                        @php
                            $mainImg = $product->image;
                            if ($mainImg && !Str::startsWith($mainImg, ['http', 'build/', 'images/'])) {
                                $mainImg = asset('storage/' . $mainImg);
                            } else {
                                $mainImg = $mainImg ? asset($mainImg) : 'https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                            }
                        @endphp
                        <img src="{{ $mainImg }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="w-full lg:w-1/2">
                    <p class="text-wood-600 font-bold uppercase tracking-widest text-sm mb-4">{{ $product->category->name }}</p>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $product->name }}</h1>
                    
                    <div class="prose prose-stone max-w-none text-gray-600 mb-10">
                        {!! $product->description !!}
                    </div>

                    @if($product->specifications)
                    <div class="mb-10">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Spesifikasi Detail</h3>
                        <div class="grid grid-cols-2 gap-y-4">
                            @foreach($product->specifications as $key => $value)
                            <div class="text-sm">
                                <span class="text-gray-500 block uppercase tracking-tighter text-[10px] font-bold">{{ $key }}</span>
                                <span class="text-gray-900 font-medium">{{ $value }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        <a href="https://wa.me/628123456789?text=Halo Pani Jaya, saya ingin bertanya tentang produk: {{ $product->name }}" target="_blank" class="flex-1 inline-flex justify-center items-center px-8 py-4 bg-green-500 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white hover:bg-green-600 transition-all transform hover:scale-105">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Tanya via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-10">Produk Terkait</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden group shadow-sm hover:shadow-xl transition-all">
                    <div class="relative h-48 overflow-hidden">
                        @php
                            $relImg = $related->image;
                            if ($relImg && !Str::startsWith($relImg, ['http', 'build/', 'images/'])) {
                                $relImg = asset('storage/' . $relImg);
                            } else {
                                $relImg = $relImg ? asset($relImg) : 'https://images.unsplash.com/photo-1494438639946-1ebd1d20bf85?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                            }
                        @endphp
                        <img src="{{ $relImg }}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="{{ $related->name }}">
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-gray-900 mb-4 truncate">{{ $related->name }}</h3>
                        <a href="/katalog/{{ $related->slug }}" class="text-wood-600 font-bold text-sm">Lihat Detail &rarr;</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
