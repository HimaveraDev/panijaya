@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Galeri Proyek Kami</h1>
            <p class="text-gray-400">Melindungi dan memperindah bangunan Anda dengan kusen premium. Berikut adalah dokumentasi instalasi terbaik kami di berbagai area.</p>
        </div>
</section>
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($projects->isEmpty())
            <div class="text-center py-24 bg-white rounded-2xl border border-gray-100 shadow-sm">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <h3 class="text-xl font-bold text-gray-900">Belum ada portofolio</h3>
                <p class="text-gray-500 mt-2">Nantikan update proyek instalasi terbaru dari kami.</p>
            </div>
        @else
            <!-- Masonry Grid Tailwind -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div class="group relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 transform border border-gray-100">
                    <!-- Image Wrapper -->
                    <div class="relative w-full h-72 overflow-hidden bg-gray-200">
                        @php
                            $img = $project->image;
                            if ($img && !Str::startsWith($img, ['http', 'build/', 'images/'])) {
                                $img = asset('storage/' . $img);
                            }
                        @endphp
                        <img src="{{ $img }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700 ease-in-out group-hover:scale-110">
                        
                        <!-- Hover Overlay (Gradient) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Date Badge -->
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg text-xs font-bold text-gray-900 shadow-sm border border-white/20">
                            {{ \Carbon\Carbon::parse($project->installation_date)->translatedFormat('d M Y') }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 relative bg-white z-10 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-wood-600 transition-colors">{{ $project->title }}</h3>
                        
                        @if($project->location)
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <svg class="w-4 h-4 mr-1.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $project->location }}
                        </div>
                        @else
                            <div class="mb-4"></div>
                        @endif

                        @if($project->description)
                        <div class="prose prose-sm text-gray-600 line-clamp-3">
                            {!! $project->description !!}
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $projects->links('pagination::tailwind') }}
            </div>
        @endif
    </div>
</section>
@endsection
