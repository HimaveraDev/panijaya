@extends('layouts.app')

@section('content')
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Tentang Kami</h1>
            <p class="text-gray-400">Dedikasi kami untuk kualitas dan keindahan hunian Anda.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-center">
                <div class="w-full lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1541824232763-d11283d47443?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" class="rounded-3xl shadow-2xl" alt="Pani Jaya Workshop">
                </div>
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold mb-6 text-gray-900">Sejarah & Visi Pani Jaya</h2>
                    <div class="prose prose-lg text-gray-600">
                        <p>Berawal dari sebuah workshop kecil di Kota Bekasi, Pani Jaya telah tumbuh menjadi salah satu penyedia kusen, pintu, dan jendela terpercaya untuk ribuan hunian dan proyek komersial.</p>
                        <p>Kami percaya bahwa setiap detail dalam konstruksi rumah memiliki nilai seni dan fungsionalitas yang tinggi. Itulah mengapa kami berkomitmen untuk hanya menggunakan material premium dan tenaga ahli yang berpengalaman.</p>
                        <h3 class="text-wood-600 font-bold mt-8">Visi Kami</h3>
                        <p>Menjadi mitra utama dalam menghadirkan hunian yang estetis, kokoh, dan modern melalui produk-produk berkualitas tinggi.</p>
                        <h3 class="text-wood-600 font-bold mt-8">Misi Kami</h3>
                        <ul class="list-disc pl-5">
                            <li>Memberikan kualitas material terbaik yang tahan lama.</li>
                            <li>Menyediakan desain custom yang mengikuti tren arsitektur terkini.</li>
                            <li>Memberikan pelayanan konsultasi dan purnajual yang memuaskan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
