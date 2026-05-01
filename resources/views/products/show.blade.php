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
                        <img src="{{ $product->image_url }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="w-full lg:w-1/2">
                    <p class="text-wood-600 font-bold uppercase tracking-widest text-sm mb-4">{{ $product->category->name }}</p>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $product->name }}</h1>
                    
                    <div class="prose prose-stone max-w-none text-gray-600 mb-10">
                        {!! $product->description !!}
                    </div>

                    @if($product->specifications && count($product->specifications) > 0)
                    <div class="mb-10">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Spesifikasi Detail</h3>
                        <div class="grid grid-cols-2 gap-y-4">
                            @foreach($product->specifications as $key => $value)
                            @php
                                $specKey = is_array($value) ? ($value['key'] ?? '') : $key;
                                $specVal = is_array($value) ? ($value['value'] ?? '') : $value;
                            @endphp
                            <div class="text-sm">
                                <span class="text-gray-500 block uppercase tracking-tighter text-[10px] font-bold">{{ $specKey }}</span>
                                <span class="text-gray-900 font-medium">{{ $specVal }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 border border-gray-100 p-6 rounded-2xl bg-gray-50/50 shadow-sm" x-data="productCalculator()">
                        <h3 class="text-lg font-bold mb-4 text-gray-900">Estimasi & Penawaran</h3>
                        
                        @if($product->base_price)
                        <div class="mb-6 p-4 bg-white rounded-xl border border-gray-100 shadow-sm">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-500">Harga Dasar</span>
                                <span class="font-bold text-wood-600" x-text="formatRupiah(basePrice)"></span>
                            </div>
                            
                            @if($product->priceOptions->count() > 0)
                            <div class="mt-4 pt-4 border-t border-gray-50">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Opsi Tambahan (Add-ons)</p>
                                <div class="space-y-1">
                                    <template x-for="opt in options" :key="opt.id">
                                        <label class="flex items-center justify-between gap-3 py-2 border-b border-gray-50 cursor-pointer hover:bg-gray-50/50 px-2 rounded-lg transition-colors">
                                            <div class="flex items-center gap-3">
                                                <input type="checkbox" :value="opt.id" x-model="selected" class="rounded border-gray-300 text-wood-600 focus:ring-wood-500">
                                                <span class="text-sm text-gray-700" x-text="opt.label"></span>
                                            </div>
                                            <span class="text-sm font-semibold text-gray-900" x-text="formatRupiah(opt.price)"></span>
                                        </label>
                                    </template>
                                </div>
                            </div>
                            @endif

                            <div class="mt-6 pt-4 border-t-2 border-dashed border-gray-100 flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold">Total Estimasi</p>
                                    <div class="text-2xl font-black text-gray-900" x-text="formatRupiah(total)"></div>
                                </div>
                            </div>
                        </div>

                        <button @click="openWa()" class="w-full inline-flex justify-center items-center px-8 py-4 bg-green-500 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white hover:bg-green-600 transition-all transform hover:scale-[1.02]">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            Konsultasi via WhatsApp
                        </button>
                        @else
                        <div class="p-6 bg-white rounded-xl border border-gray-100 text-center">
                            <p class="text-sm text-gray-500 mb-4">Hubungi kami langsung untuk mendapatkan penawaran harga terbaik sesuai kebutuhan Anda.</p>
                            <a href="https://wa.me/{{ $siteSettings->whatsapp_number }}?text={{ urlencode('Halo Pani Jaya, saya ingin tanya harga untuk produk: ' . $product->name) }}" target="_blank" class="w-full inline-flex justify-center items-center px-8 py-4 bg-green-500 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white hover:bg-green-600 transition-all transform hover:scale-[1.02]">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Konsultasi Jasa & Produk
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    @if($product->hasMarketplace())
                    <div class="mt-6 border border-gray-100 p-6 rounded-2xl bg-white shadow-sm">
                        <h3 class="text-lg font-bold mb-4 text-gray-900">Beli via Marketplace</h3>
                        <div class="flex flex-col gap-3">
                            @if(isset($product->marketplace_links['shopee']))
                            <a href="{{ $product->marketplace_links['shopee'] }}" target="_blank" rel="noopener" class="w-full inline-flex justify-center items-center px-6 py-3 bg-orange-500 border border-transparent rounded-xl shadow-md text-white font-bold hover:bg-orange-600 transition-all transform hover:scale-[1.02]">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Beli di Shopee
                            </a>
                            @endif
                            
                            @if(isset($product->marketplace_links['tokopedia']))
                            <a href="{{ $product->marketplace_links['tokopedia'] }}" target="_blank" rel="noopener" class="w-full inline-flex justify-center items-center px-6 py-3 bg-green-500 border border-transparent rounded-xl shadow-md text-white font-bold hover:bg-green-600 transition-all transform hover:scale-[1.02]">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Beli di Tokopedia
                            </a>
                            @endif

                            @if(isset($product->marketplace_links['tiktok']))
                            <a href="{{ $product->marketplace_links['tiktok'] }}" target="_blank" rel="noopener" class="w-full inline-flex justify-center items-center px-6 py-3 bg-black border border-transparent rounded-xl shadow-md text-white font-bold hover:bg-gray-900 transition-all transform hover:scale-[1.02]">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Beli di TikTok Shop
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    {{-- ================================================================
         TABEL PERBANDINGAN MATERIAL — Static Blade, No DB Query
         Letakkan SEBELUM Produk Terkait sesuai instruksi.
    ================================================================ --}}
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="inline-block bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-widest py-1 px-3 rounded-full mb-4 border border-amber-200">Panduan Material</span>
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Perbandingan Jenis Kayu</h2>
                <p class="text-gray-500 max-w-xl mx-auto text-sm">Pilih material yang tepat sesuai kebutuhan, anggaran, dan kondisi lingkungan bangunan Anda.</p>
            </div>

            {{-- Desktop Table --}}
            <div class="hidden md:block overflow-hidden rounded-2xl border border-gray-200 shadow-sm">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-900 text-white">
                            <th class="px-6 py-4 text-left font-bold tracking-wide">Material Kayu</th>
                            <th class="px-6 py-4 text-center font-bold tracking-wide">Kekuatan</th>
                            <th class="px-6 py-4 text-center font-bold tracking-wide">Tahan Cuaca</th>
                            <th class="px-6 py-4 text-center font-bold tracking-wide">Harga Relatif</th>
                            <th class="px-6 py-4 text-left font-bold tracking-wide">Terbaik Untuk</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        {{-- Jati --}}
                        <tr class="bg-amber-50/50 hover:bg-amber-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-700 flex items-center justify-center text-white text-xs font-bold shrink-0">JT</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Jati</div>
                                        <div class="text-xs text-amber-700 font-semibold">Premium ✦</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★★★★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★★★★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full">Tinggi</span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">Kusen eksterior premium, bangunan mewah, jangka panjang 50+ tahun</td>
                        </tr>
                        {{-- Mahoni --}}
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-rose-800 flex items-center justify-center text-white text-xs font-bold shrink-0">MH</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Mahoni</div>
                                        <div class="text-xs text-rose-700 font-semibold">Menengah</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★★★</span><span class="text-gray-200 text-lg">★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★★★</span><span class="text-gray-200 text-lg">★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">Menengah</span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">Interior & eksterior residensial, kusen pintu dan jendela standar</td>
                        </tr>
                        {{-- Meranti --}}
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-orange-600 flex items-center justify-center text-white text-xs font-bold shrink-0">MR</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Meranti</div>
                                        <div class="text-xs text-orange-600 font-semibold">Standar</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★★</span><span class="text-gray-200 text-lg">★★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★★</span><span class="text-gray-200 text-lg">★★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full">Terjangkau</span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">Proyek volume besar, perumahan komersial, area interior terlindung</td>
                        </tr>
                        {{-- Pinus --}}
                        <tr class="bg-white hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-lime-600 flex items-center justify-center text-white text-xs font-bold shrink-0">PN</div>
                                    <div>
                                        <div class="font-bold text-gray-900">Pinus</div>
                                        <div class="text-xs text-lime-700 font-semibold">Ekonomis</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★</span><span class="text-gray-200 text-lg">★★★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="text-amber-500 text-lg tracking-tight">★★</span><span class="text-gray-200 text-lg">★★★</span>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="inline-block bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Ekonomis</span>
                            </td>
                            <td class="px-6 py-5 text-gray-600">Interior ringan, furniture, area tidak terpapar langsung cuaca</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards --}}
            <div class="md:hidden grid grid-cols-1 gap-4">
                @foreach([
                    ['code'=>'JT','color'=>'bg-amber-700','name'=>'Jati','tier'=>'Premium ✦','tier_color'=>'text-amber-700','str'=>5,'wet'=>5,'price'=>'Tinggi','price_color'=>'bg-red-100 text-red-700','use'=>'Eksterior premium, 50+ tahun'],
                    ['code'=>'MH','color'=>'bg-rose-800','name'=>'Mahoni','tier'=>'Menengah','tier_color'=>'text-rose-700','str'=>4,'wet'=>4,'price'=>'Menengah','price_color'=>'bg-orange-100 text-orange-700','use'=>'Interior & eksterior residensial'],
                    ['code'=>'MR','color'=>'bg-orange-600','name'=>'Meranti','tier'=>'Standar','tier_color'=>'text-orange-600','str'=>3,'wet'=>3,'price'=>'Terjangkau','price_color'=>'bg-green-100 text-green-700','use'=>'Volume besar, perumahan komersial'],
                    ['code'=>'PN','color'=>'bg-lime-600','name'=>'Pinus','tier'=>'Ekonomis','tier_color'=>'text-lime-700','str'=>2,'wet'=>2,'price'=>'Ekonomis','price_color'=>'bg-blue-100 text-blue-700','use'=>'Interior ringan, furniture'],
                ] as $m)
                <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl {{ $m['color'] }} flex items-center justify-center text-white text-xs font-bold">{{ $m['code'] }}</div>
                        <div>
                            <div class="font-bold text-gray-900">{{ $m['name'] }}</div>
                            <div class="text-xs {{ $m['tier_color'] }} font-semibold">{{ $m['tier'] }}</div>
                        </div>
                        <span class="ml-auto inline-block {{ $m['price_color'] }} text-xs font-bold px-3 py-1 rounded-full">{{ $m['price'] }}</span>
                    </div>
                    <div class="grid grid-cols-2 gap-3 text-xs text-gray-600">
                        <div>
                            <span class="block text-gray-400 mb-0.5 uppercase tracking-wider">Kekuatan</span>
                            <span class="text-amber-500">{{ str_repeat('★', $m['str']) }}</span><span class="text-gray-200">{{ str_repeat('★', 5 - $m['str']) }}</span>
                        </div>
                        <div>
                            <span class="block text-gray-400 mb-0.5 uppercase tracking-wider">Tahan Cuaca</span>
                            <span class="text-amber-500">{{ str_repeat('★', $m['wet']) }}</span><span class="text-gray-200">{{ str_repeat('★', 5 - $m['wet']) }}</span>
                        </div>
                    </div>
                    <p class="mt-3 text-xs text-gray-500 italic">Terbaik untuk: {{ $m['use'] }}</p>
                </div>
                @endforeach
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
                        <img src="{{ $related->image_url }}" class="w-full h-full object-cover transition-transform group-hover:scale-105" alt="{{ $related->name }}">
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

    <script>
        window.productData = {
            basePrice: {{ $product->base_price ?? 0 }},
            options: @json($product->priceOptions ?? [])
        };
    </script>

    @push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productCalculator', () => ({
            basePrice: window.productData.basePrice || 0,
            options: window.productData.options || [],
            selected: [],

            get total() {
                let sum = parseInt(this.basePrice);
                this.selected.forEach(id => {
                    const opt = this.options.find(o => o.id == id);
                    if (opt) sum += parseInt(opt.price);
                });
                return sum;
            },

            formatRupiah(num) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(num || 0);
            },

            async openWa() {
                const selectedOptions = this.options
                    .filter(o => this.selected.includes(o.id.toString()) || this.selected.includes(o.id))
                    .map(o => `• ${o.label} (${this.formatRupiah(o.price)})`)
                    .join('\n');

                // Backend Validation
                let validatedTotal = this.total;
                try {
                    const response = await fetch('{{ route('generate.wa.message') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: {{ $product->id }},
                            options: this.selected
                        })
                    });
                    const data = await response.json();
                    validatedTotal = data.total;
                } catch (e) {
                    console.error('Backend validation failed, using local total', e);
                }

                const message =
`Halo Pani Jaya, saya ingin konsultasi:

Produk: {{ $product->name }}
Harga Dasar: ${this.formatRupiah(this.basePrice)}

Opsi Tambahan:
${selectedOptions || '- Tidak ada'}

Total Estimasi:
${this.formatRupiah(validatedTotal)}

Mohon penawaran resminya. Terima kasih.`;

                const url = `https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings->whatsapp_number) }}?text=${encodeURIComponent(message)}`;
                window.open(url, '_blank');
            }
        }))
    });
    </script>
    @endpush
@endsection
