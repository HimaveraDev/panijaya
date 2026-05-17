@extends('layouts.app')

@section('content')
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold mb-4">Metode Pembayaran</h1>
            <p class="text-gray-400">Informasi lengkap transaksi aman bersama Pani Jaya.</p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-50 rounded-3xl p-12 shadow-sm border border-gray-100">

                <h2 class="text-2xl font-bold mb-8">Cara Berbelanja</h2>
                <div class="space-y-6 mb-12">
                    <div class="flex items-start">
                        <div
                            class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">
                            1</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Pilih Produk</h4>
                            <p class="text-gray-600 text-sm">Pilih produk kusen atau pintu yang Anda inginkan dari katalog
                                kami.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">
                            2</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Konsultasi via WhatsApp</h4>
                            <p class="text-gray-600 text-sm">Klik tombol WhatsApp untuk diskusi mengenai ukuran, material,
                                dan harga.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">
                            3</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Konfigurasi & DP</h4>
                            <p class="text-gray-600 text-sm">Lakukan pembayaran Down Payment (DP) 50% setelah spesifikasi
                                disepakati.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div
                            class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">
                            4</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Produksi & Pelunasan</h4>
                            <p class="text-gray-600 text-sm">Barang diproduksi dan pelunasan dilakukan sebelum pengiriman
                                atau sesuai kesepakatan.</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-8 pt-8 border-t border-gray-200">Pilihan Pembayaran</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-2xl border border-gray-200">
                        <h4 class="font-bold text-gray-500 text-xs uppercase tracking-widest mb-4">Transfer Bank</h4>
                        <p class="font-bold text-lg mb-1">Bank Central Asia (BCA)</p>
                        <p class="text-2xl font-mono text-wood-600 mb-2">123-456-7890</p>
                        <p class="text-xs text-gray-400">A/N PT PANI JAYA ABADI</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl border border-gray-200">
                        <h4 class="font-bold text-gray-500 text-xs uppercase tracking-widest mb-4">Tunai / Cash</h4>
                        <p class="font-bold text-lg mb-2">Pembayaran Langsung</p>
                        <p class="text-sm text-gray-600">Dapat dilakukan di workshop kami di alamat yang tertera di footer.
                        </p>
                    </div>
                </div>

                @if($siteSettings->hasMarketplace())
                    <div class="mt-8 border-t border-gray-200 pt-8">
                        <div class="flex items-center gap-3 mb-6">
                            <h4 class="font-bold text-gray-900 text-lg">Alternatif Pembayaran (Marketplace)</h4>
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Praktis &
                                Aman</span>
                        </div>
                        <p class="text-sm text-gray-600 mb-6">Nikmati kemudahan transaksi melalui platform marketplace favorit
                            Anda. Dapatkan fitur cicilan, promo gratis ongkir, dan perlindungan pembeli (e-wallet, paylater,
                            credit card).</p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            @if(isset($siteSettings->marketplace_links['shopee']))
                                <a href="{{ $siteSettings->marketplace_links['shopee'] }}" target="_blank" rel="noopener"
                                    class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-orange-500 hover:shadow-md transition-all group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500">
                                            <img src="https://img.icons8.com/color/480/shopee.png" class="w-8 h-8 object-contain"
                                                alt="Shopee">
                                        </div>
                                        <span
                                            class="font-bold text-gray-900 group-hover:text-orange-500 transition-colors">Shopee</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-300 group-hover:text-orange-500 transition-colors" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif

                            @if(isset($siteSettings->marketplace_links['tokopedia']))
                                <a href="{{ $siteSettings->marketplace_links['tokopedia'] }}" target="_blank" rel="noopener"
                                    class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-green-500 hover:shadow-md transition-all group">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-500">
                                            <img src="https://www.freepnglogos.com/uploads/logo-tokopedia-png/berita-tokopedia-info-berita-terbaru-tokopedia-6.png"
                                                class="w-8 h-8 object-contain" alt="Tokopedia">
                                        </div>
                                        <span
                                            class="font-bold text-gray-900 group-hover:text-green-500 transition-colors">Tokopedia</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-300 group-hover:text-green-500 transition-colors" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif

                            @if(isset($siteSettings->marketplace_links['tiktok']))
                                <a href="{{ $siteSettings->marketplace_links['tiktok'] }}" target="_blank" rel="noopener"
                                    class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-xl hover:border-black hover:shadow-md transition-all group">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center text-gray-900">
                                            <img src="https://img.icons8.com/color/480/tiktok--v1.png"
                                                class="w-8 h-8 object-contain" alt="TikTok Shop">
                                        </div>
                                        <span class="font-bold text-gray-900 group-hover:text-black transition-colors">TikTok
                                            Shop</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-300 group-hover:text-black transition-colors" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="pb-24 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="border-t border-gray-100 pt-12">
                <p class="text-center text-sm font-semibold text-gray-900 uppercase tracking-widest">
                    Mendukung Berbagai Metode Pembayaran Aman
                </p>
                <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 mt-8">
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://images.archbee.com/ueSgidS-H3kdWkcRhVS2v-ox8uhzkO7AuytjK0U4Shy-20250903-041516.png?format=webp&width=800"
                            class="h-24 sm:h-24 w-auto object-contain" alt="Shopee Paylater">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://images.seeklogo.com/logo-png/43/1/gopaylater-logo-png_seeklogo-438540.png"
                            class="h-40 sm:h-40 w-auto object-contain" alt="GoPay Later">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://images.seeklogo.com/logo-png/39/1/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png"
                            class="h-36 sm:h-36 w-auto object-contain" alt="QRIS">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Visa_Inc._logo_%282005%E2%80%932014%29.png"
                            class="h-10 sm:h-10 w-auto object-contain" alt="Visa">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://images.seeklogo.com/logo-png/36/1/gpn-logo-png_seeklogo-365866.png"
                            class="h-20 sm:h-20 w-auto object-contain" alt="GPN">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Mastercard_2019_logo.svg"
                            class="h-16 sm:h-16 w-auto object-contain" alt="Mastercard">
                    </div>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-4 sm:gap-6 mt-4">
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://www.bca.co.id/-/media/Feature/Card/List-Card/Tentang-BCA/Brand-Assets/Logo-BCA/Logo-BCA_Biru.png"
                            class="h-32 sm:h-32 w-auto object-contain" alt="BCA">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/52/Dana_logo.png"
                            class="h-10 sm:h-10 w-auto object-contain" alt="Dana">
                    </div>
                    <div class="bg-white rounded-xl flex items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg"
                            class="h-10 sm:h-10 w-auto object-contain" alt="OVO">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection