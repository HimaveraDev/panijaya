@extends('layouts.app')

@section('content')
    <article class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <header class="mb-12">
                <nav class="flex mb-6 text-sm text-gray-500">
                    <a href="/" class="hover:text-wood-600">Home</a>
                    <span class="mx-2">/</span>
                    <a href="/artikel" class="hover:text-wood-600">Artikel</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900 font-medium line-clamp-1">{{ $article->title }}</span>
                </nav>
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">{{ $article->title }}</h1>
                <div class="flex items-center text-gray-500 text-sm">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-wood-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $article->published_at?->format('d M Y') }}
                    </span>
                    <span class="mx-4">|</span>
                    <span class="flex items-center uppercase tracking-widest font-bold text-wood-600 text-[10px]">
                        Pani Jaya Blog
                    </span>
                </div>
            </header>

            <div class="aspect-video rounded-3xl overflow-hidden mb-12 shadow-2xl">
                @php
                    $coverImg = $article->thumbnail;
                    if ($coverImg && !Str::startsWith($coverImg, ['http', 'build/', 'images/'])) {
                        $coverImg = asset('storage/' . $coverImg);
                    } else {
                        $coverImg = $coverImg ? asset($coverImg) : 'https://images.unsplash.com/photo-1588644972368-d1e5927d9220?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
                    }
                @endphp
                <img src="{{ $coverImg }}" class="w-full h-full object-cover" alt="{{ $article->title }}">
            </div>

            <div class="prose prose-lg prose-wood max-w-none text-gray-700 leading-relaxed first-letter:text-5xl first-letter:font-bold first-letter:mr-3 first-letter:float-left first-letter:text-wood-600">
                {!! $article->content !!}
            </div>

            <div class="mt-20 pt-10 border-t border-gray-100 italic text-gray-500">
                Bagikan artikel ini jika bermanfaat bagi Anda.
            </div>
        </div>
    </article>

    <!-- Sidebar / More Articles -->
    @if($latestArticles->count() > 0)
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-10">Artikel Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestArticles as $latest)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-transparent hover:border-wood-200 transition-all">
                    <h3 class="font-bold text-lg mb-4 line-clamp-2"><a href="/artikel/{{ $latest->slug }}" class="hover:text-wood-600">{{ $latest->title }}</a></h3>
                    <a href="/artikel/{{ $latest->slug }}" class="text-sm font-bold text-wood-600">Baca Lanjut &rarr;</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection
