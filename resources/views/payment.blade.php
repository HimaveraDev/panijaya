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
                        <div class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">1</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Pilih Produk</h4>
                            <p class="text-gray-600 text-sm">Pilih produk kusen atau pintu yang Anda inginkan dari katalog kami.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">2</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Konsultasi via WhatsApp</h4>
                            <p class="text-gray-600 text-sm">Klik tombol WhatsApp untuk diskusi mengenai ukuran, material, dan harga.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">3</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Konfigurasi & DP</h4>
                            <p class="text-gray-600 text-sm">Lakukan pembayaran Down Payment (DP) 50% setelah spesifikasi disepakati.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="bg-wood-600 text-white w-8 h-8 rounded-full flex items-center justify-center shrink-0 mt-1 font-bold">4</div>
                        <div class="ml-4">
                            <h4 class="font-bold">Produksi & Pelunasan</h4>
                            <p class="text-gray-600 text-sm">Barang diproduksi dan pelunasan dilakukan sebelum pengiriman atau sesuai kesepakatan.</p>
                        </div>
                    </div>
                </div>

                <h2 class="text-2xl font-bold mb-8 pt-8 border-t">Pilihan Pembayaran</h2>
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
                        <p class="text-sm text-gray-600">Dapat dilakukan di workshop kami di alamat yang tertera di footer.</p>
                    </div>
                </div>

                <div class="mt-12 bg-wood-50 p-6 rounded-2xl border border-wood-100 flex items-center">
                    <svg class="w-6 h-6 text-wood-600 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-sm text-wood-900">Pastikan Anda hanya melakukan transfer ke nomor rekening resmi di atas untuk keamanan transaksi.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
