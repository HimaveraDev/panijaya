<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk — {{ $siteName }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            background: #fff;
        }

        /* Header */
        .header {
            background: #1c1917;
            color: #fff;
            padding: 28px 32px;
            margin-bottom: 28px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .header p {
            font-size: 11px;
            color: #a8a29e;
        }
        .header .badge {
            display: inline-block;
            background: #d97706;
            color: #fff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 3px 8px;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        /* Wrapper */
        .content { padding: 0 32px 32px; }

        /* Meta info row */
        .meta-row {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            background: #f9f7f5;
            border: 1px solid #e7e5e4;
            border-radius: 6px;
            padding: 10px 16px;
        }
        .meta-col { display: table-cell; }
        .meta-col.right { text-align: right; color: #78716c; }
        .meta-label { font-size: 9px; color: #78716c; text-transform: uppercase; letter-spacing: 0.5px; }
        .meta-val { font-size: 12px; font-weight: 600; color: #1c1917; margin-top: 2px; }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            background: #292524;
            color: #fff;
            padding: 10px 12px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        thead th:first-child { border-radius: 4px 0 0 0; }
        thead th:last-child  { border-radius: 0 4px 0 0; }

        tbody tr:nth-child(even) { background: #fafaf9; }
        tbody tr:nth-child(odd)  { background: #ffffff; }
        tbody tr { border-bottom: 1px solid #e7e5e4; }

        tbody td {
            padding: 10px 12px;
            vertical-align: middle;
            font-size: 11px;
        }

        /* Product image in table */
        .product-img {
            width: 48px;
            height: 48px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #e7e5e4;
        }
        .no-img {
            width: 48px;
            height: 48px;
            background: #e7e5e4;
            border-radius: 4px;
            display: table-cell;
            text-align: center;
            vertical-align: middle;
            font-size: 8px;
            color: #a8a29e;
        }

        .product-name { font-weight: 600; color: #1c1917; font-size: 12px; }
        .category-badge {
            display: inline-block;
            background: #fef3c7;
            color: #92400e;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            margin-top: 3px;
        }
        .row-number { color: #a8a29e; font-size: 10px; }

        /* Footer */
        .footer {
            margin-top: 28px;
            padding-top: 16px;
            border-top: 1px solid #e7e5e4;
            display: table;
            width: 100%;
        }
        .footer-left, .footer-right { display: table-cell; font-size: 9px; color: #a8a29e; }
        .footer-right { text-align: right; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="badge">Katalog Resmi</div>
        <h1>{{ $siteName }}</h1>
        <p>Kusen, Pintu, Jendela &amp; Roster Berkualitas Premium</p>
    </div>

    <div class="content">

        <!-- Meta info -->
        <div class="meta-row">
            <div class="meta-col">
                <div class="meta-label">Total Produk</div>
                <div class="meta-val">{{ $products->count() }} Produk Aktif</div>
            </div>
            <div class="meta-col right">
                <div class="meta-label">Digenerate</div>
                <div class="meta-val">{{ $generatedAt }}</div>
            </div>
        </div>

        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">#</th>
                    <th style="width: 60px;">Foto</th>
                    <th>Nama Produk</th>
                    <th style="width: 120px;">Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $index => $product)
                <tr>
                    <td class="row-number">{{ $index + 1 }}</td>
                    <td>
                        @if($product['image'])
                            <img src="{{ $product['image'] }}" class="product-img" alt="{{ $product['name'] }}">
                        @else
                            <table style="width:48px;height:48px;background:#e7e5e4;border-radius:4px;">
                                <tr><td style="text-align:center;font-size:8px;color:#a8a29e;">No<br>Img</td></tr>
                            </table>
                        @endif
                    </td>
                    <td>
                        <div class="product-name">{{ $product['name'] }}</div>
                    </td>
                    <td>
                        <span class="category-badge">{{ $product['category'] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-left">© {{ now()->year }} {{ $siteName }} — Katalog ini bersifat informatif dan dapat berubah sewaktu-waktu.</div>
            <div class="footer-right">Hubungi kami untuk penawaran & konsultasi</div>
        </div>

    </div>
</body>
</html>
