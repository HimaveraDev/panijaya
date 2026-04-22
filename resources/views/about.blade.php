@extends('layouts.app')

@section('content')
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">{{ $siteSettings->about_hero_title ?? 'Tentang Kami' }}</h1>
            <p class="text-gray-400">{{ $siteSettings->about_hero_description ?? 'Dedikasi kami untuk kualitas dan keindahan hunian Anda.' }}</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center border-b border-gray-100 pb-24">
                <div class="w-full lg:w-1/2">
                    <img src="{{ $siteSettings->about_image_url }}" class="rounded-3xl shadow-2xl" alt="Pani Jaya Workshop">
                </div>
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">{{ $siteSettings->about_history_title ?? 'Sejarah & Visi Pani Jaya' }}</h2>
                    <div class="prose prose-lg text-gray-600">
                        @if($siteSettings->about_history)
                            {!! $siteSettings->about_history !!}
                        @endif

                        @if($siteSettings->about_vision)
                            <h3 class="text-wood-600 font-bold mt-8 italic">Visi Kami</h3>
                            {!! $siteSettings->about_vision !!}
                        @endif

                        @if($siteSettings->about_mission)
                            <h3 class="text-wood-600 font-bold mt-8 italic">Misi Kami</h3>
                            {!! $siteSettings->about_mission !!}
                        @endif

                        @if(!$siteSettings->about_history && !$siteSettings->about_vision && !$siteSettings->about_mission)
                            <p>Berawal dari sebuah workshop kecil di Kota Bekasi, Pani Jaya telah tumbuh menjadi salah satu penyedia kusen, pintu, dan jendela terpercaya untuk ribuan hunian dan proyek komersial.</p>
                            <p>Kami percaya bahwa setiap detail dalam konstruksi rumah memiliki nilai seni dan fungsionalitas yang tinggi. Itulah mengapa kami berkomitmen untuk hanya menggunakan material premium dan tenaga ahli yang berpengalaman.</p>
                            <h3 class="text-wood-600 font-bold mt-8 italic">Visi Kami</h3>
                            <p>Menjadi mitra utama dalam menghadirkan hunian yang estetis, kokoh, dan modern melalui produk-produk berkualitas tinggi.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 tracking-tight">Lokasi Kami</h2>
                <div class="w-20 h-1 bg-wood-600 mx-auto mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">Kunjungi workshop kami untuk melihat langsung kualitas material dan berkonsultasi mengenai kebutuhan hunian Anda.</p>
            </div>
            
            <div class="w-full rounded-3xl overflow-hidden shadow-2xl border-8 border-white bg-white" style="height: 500px; min-height: 500px;">
                <iframe 
                    src="{{ $siteSettings->google_maps_url ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15864.237701168536!2d106.983!3d-6.236!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c2534f315a9%3A0xc4864c297864f1e9!2sJl.%20Jend.%20Sudirman%2C%20Bekasi%2C%20Kota%20Bks%2C%20Jawa%20Barat!5e0!3m2!1id!2sid!4v1713175000000!5m2!1sid!2sid' }}" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-wood-50 rounded-full flex items-center justify-center text-wood-600 mb-6 font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Alamat</h4>
                    <p class="text-gray-600 text-sm">{{ $siteSettings->address }}</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-wood-50 rounded-full flex items-center justify-center text-wood-600 mb-6 font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Jam Operasional</h4>
                    <p class="text-gray-600 text-sm">Senin - Sabtu: 08:00 - 17:00</p>
                    <p class="text-gray-400 text-xs mt-1">Minggu & Libur Nasional: Tutup</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-12 h-12 bg-wood-50 rounded-full flex items-center justify-center text-wood-600 mb-6 font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Hubungi Kami</h4>
                    <p class="text-gray-600 text-sm">{{ $siteSettings->whatsapp_number }}</p>
                    <p class="text-gray-400 text-xs mt-1">Tersedia via WhatsApp</p>
                </div>
            </div>
        </div>
    </section>
@endsection
