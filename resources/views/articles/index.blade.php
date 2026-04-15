@extends('layouts.app')

@section('content')
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Artikel & Tips</h1>
            <p class="text-gray-400">Seputar konstruksi, tips perawatan kusen, dan inspirasi desain hunian modern.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($articles->isEmpty())
                <p class="text-center text-gray-500">Belum ada artikel.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 mb-16">
                    @foreach($articles as $article)
                    <article class="bg-white rounded-3xl overflow-hidden group shadow-sm hover:shadow-2xl transition-all border border-gray-100">
                        <div class="h-64 overflow-hidden relative">
                            @php
                                $articleImg = $article->thumbnail;
                                if ($articleImg && !Str::startsWith($articleImg, ['http', 'build/', 'images/'])) {
                                    $articleImg = asset('storage/' . $articleImg);
                                } else {
                                    $articleImg = $articleImg ? asset($articleImg) : 'https://images.unsplash.com/photo-1588644972368-d1e5927d9220?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80';
                                }
                            @endphp
                            <img src="{{ $articleImg }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $article->title }}">
                            <div class="absolute top-4 left-4">
                                <span class="bg-wood-600 text-white text-[10px] px-3 py-1.5 rounded-full font-bold uppercase tracking-wider">
                                    {{ $article->published_at?->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-10">
                            <h2 class="text-2xl font-bold mb-4 group-hover:text-wood-600 transition-colors leading-tight">
                                <a href="/artikel/{{ $article->slug }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-gray-500 line-clamp-3 mb-8 text-sm leading-relaxed">
                                {{ strip_tags($article->content) }}
                            </p>
                            <a href="/artikel/{{ $article->slug }}" class="inline-flex items-center text-wood-600 font-bold hover:translate-x-2 transition-transform">
                                Baca Selengkapnya <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
                
                {{ $articles->links() }}
            @endif
        </div>
    </section>
@endsection
