@extends('layouts.app')

@section('content')
    <!-- Header -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold mb-4">Katalog Produk</h1>
                    <p class="text-gray-400">Temukan berbagai pilihan kusen, pintu, dan jendela untuk kebutuhan konstruksi Anda.</p>
                </div>
                <a href="{{ route('catalog.pdf') }}"
                   class="inline-flex items-center gap-2 self-start sm:self-center px-5 py-3 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-xl transition-all duration-200 shadow-lg hover:shadow-amber-500/30 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Unduh Katalog PDF
                </a>
            </div>
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

    {{-- ============================================================
         KALKULATOR ESTIMASI HARGA
         $pricingConfig dikirim dari ProductController (sumber: DB dengan
         fallback ke config/pricing.php jika tabel kosong).
    ============================================================ --}}
    @php
        $waNumber = config('services.panijaya.wa_number', '628123456789');
    @endphp

    <section class="py-20 bg-gray-900">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block bg-amber-600/20 text-amber-400 text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full mb-4">Alat Bantu</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Kalkulator Estimasi Harga</h2>
                <p class="text-gray-400 max-w-xl mx-auto">Isi parameter di bawah untuk mendapatkan perkiraan harga kasar. Hubungi kami untuk penawaran resmi.</p>
            </div>

            {{-- x-data sekarang hanya referensi function — BUKAN object inline --}}
            <div x-data="calculatorData" class="bg-white/5 border border-white/10 rounded-3xl p-8 md:p-10 backdrop-blur-sm">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Jenis Produk --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Jenis Produk</label>
                        <select x-model="productType" @change="result = null"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                            <option value="kusen_pintu"   class="text-gray-900">Kusen Pintu</option>
                            <option value="kusen_jendela" class="text-gray-900">Kusen Jendela</option>
                            <option value="daun_pintu"    class="text-gray-900">Daun Pintu</option>
                            <option value="roster"        class="text-gray-900">Roster</option>
                        </select>
                    </div>

                    {{-- Jenis Kayu --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">Jenis Kayu / Material</label>
                        <select x-model="material" @change="result = null"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                            <option value="jati"    class="text-gray-900">Kayu Jati (Premium)</option>
                            <option value="mahoni"  class="text-gray-900">Kayu Mahoni (Menengah)</option>
                            <option value="meranti" class="text-gray-900">Kayu Meranti (Standar)</option>
                            <option value="pinus"   class="text-gray-900">Kayu Pinus (Ekonomis)</option>
                        </select>
                    </div>

                    {{-- Panjang --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Panjang <span class="text-gray-500 font-normal">(cm)</span>
                        </label>
                        <input type="number" x-model="length" @input="result = null" min="1" max="2000"
                            placeholder="cth: 210"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-xl px-4 py-3 text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                    </div>

                    {{-- Lebar --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">
                            Lebar <span class="text-gray-500 font-normal">(cm)</span>
                        </label>
                        <input type="number" x-model="width" @input="result = null" min="1" max="2000"
                            placeholder="cth: 90"
                            class="w-full bg-white/10 border border-white/20 text-white rounded-xl px-4 py-3 text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-amber-500 transition">
                    </div>
                </div>

                {{-- Error --}}
                <div x-show="hasError" x-transition
                    class="mt-4 text-sm text-red-400 bg-red-900/30 border border-red-700/40 rounded-xl px-4 py-3"
                    x-text="errorMsg">
                </div>

                {{-- Hitung --}}
                <button @click="calculate()"
                    class="mt-6 w-full py-4 bg-amber-600 hover:bg-amber-500 text-white font-bold rounded-xl text-base transition-all duration-200 shadow-lg hover:shadow-amber-500/30">
                    Hitung Estimasi
                </button>

                {{-- Hasil --}}
                <div x-show="result !== null"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="mt-6 bg-amber-600/10 border border-amber-500/30 rounded-2xl p-6">

                    <p class="uppercase tracking-widest text-xs text-amber-300/70 font-medium mb-1">Estimasi Harga Kasar</p>
                    <p class="text-4xl font-bold text-amber-400 mb-1" x-text="formatRupiah(result)"></p>
                    <p class="text-xs text-gray-500 mb-5">
                        Harga bersifat estimasi. Harga aktual bergantung finishing, kerumitan, dan volume order.
                    </p>

                    <button @click="openWa()"
                        class="w-full inline-flex justify-center items-center gap-3 py-4 bg-green-600 hover:bg-green-500 rounded-xl font-bold text-white transition-all duration-200 text-base shadow-lg hover:shadow-green-500/20">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Lanjut Konsultasi via WhatsApp
                    </button>
                </div>

            </div>{{-- end x-data --}}
        </div>
    </section>

@endsection

@push('scripts')
{{--
    Sumber data: $pricingConfig dari ProductController
    (DB → fallback config). Alpine.data() dipanggil SEBELUM CDN defer.
--}}
<script>
    window.__pricingConfig = {
        basePrice: @json($pricingConfig['basePrice']),
        matFactor: @json($pricingConfig['matFactor']),
        minPrice:  @json($pricingConfig['minPrice']),
        waNumber:  '{{ $waNumber }}'
    };

    // Alpine.data() — wajib untuk x-data="calculatorData" (tanpa tanda kurung)
    document.addEventListener('alpine:init', () => {
        Alpine.data('calculatorData', () => ({
            // State
            productType: 'kusen_pintu',
            material:    'meranti',
            length:      '',
            width:       '',
            result:      null,
            hasError:    false,
            errorMsg:    '',

            // Methods
            calculate() {
                const p = parseFloat(this.length);
                const l = parseFloat(this.width);

                if (!p || !l || p <= 0 || l <= 0) {
                    this.hasError = true;
                    this.errorMsg = 'Mohon isi panjang dan lebar dengan angka yang valid.';
                    this.result   = null;
                    return;
                }

                this.hasError = false;
                this.errorMsg = '';

                const cfg      = window.__pricingConfig;
                const areaM2   = (p * l) / 10000;
                const base     = cfg.basePrice[this.productType] ?? 0;
                const factor   = cfg.matFactor[this.material]    ?? 1;
                const minVal   = cfg.minPrice[this.productType]  ?? 0;

                this.result = Math.max(base * factor * areaM2, minVal);
            },

            formatRupiah(num) {
                return new Intl.NumberFormat('id-ID', {
                    style:                 'currency',
                    currency:              'IDR',
                    maximumFractionDigits: 0
                }).format(num);
            },

            openWa() {
                if (this.result === null) {
                    this.calculate();
                    return;
                }

                const productLabels = {
                    kusen_pintu:   'Kusen Pintu',
                    kusen_jendela: 'Kusen Jendela',
                    daun_pintu:    'Daun Pintu',
                    roster:        'Roster'
                };
                const matLabels = {
                    jati:    'Jati',
                    mahoni:  'Mahoni',
                    meranti: 'Meranti',
                    pinus:   'Pinus'
                };

                const prod = productLabels[this.productType] || this.productType;
                const mat  = matLabels[this.material]        || this.material;
                const msg  = 'Halo Pani Jaya, saya ingin konsultasi estimasi:\n'
                           + '• Produk: '          + prod                         + '\n'
                           + '• Material: Kayu '   + mat                          + '\n'
                           + '• Ukuran: '          + this.length + ' cm × ' + this.width + ' cm\n'
                           + '• Estimasi Harga: '  + this.formatRupiah(this.result) + '\n\n'
                           + 'Mohon informasi penawaran resminya. Terima kasih.';

                window.open(
                    'https://wa.me/' + window.__pricingConfig.waNumber + '?text=' + encodeURIComponent(msg),
                    '_blank'
                );
            }
        }));   // end Alpine.data callback
    });        // end alpine:init listener
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush


