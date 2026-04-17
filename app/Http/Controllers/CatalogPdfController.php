<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class CatalogPdfController extends Controller
{
    public function download(): Response
    {
        // Memory safety untuk rendering PDF dengan banyak gambar
        ini_set('memory_limit', '256M');

        // Query optimal: hanya kolom yang dibutuhkan PDF
        $products = Product::select('name', 'image', 'category_id')
            ->with('category:id,name')
            ->get()
            ->map(function ($product) {
                // Resolusi path gambar ke filesystem absolut (wajib untuk dompdf, bukan asset())
                $imagePath = null;
                if ($product->image) {
                    $absPath = public_path('storage/' . $product->image);
                    $imagePath = file_exists($absPath) ? $absPath : null;
                }
                return [
                    'name'     => $product->name,
                    'category' => $product->category->name ?? '-',
                    'image'    => $imagePath,
                ];
            });

        $pdf = Pdf::loadView('pdf.catalog', [
            'products'    => $products,
            'generatedAt' => now()->translatedFormat('d F Y'),
            'siteName'    => config('app.name'),
        ])
        ->setPaper('a4', 'portrait')
        ->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled'      => false, // Keamanan: nonaktifkan remote URL
            'defaultFont'          => 'DejaVu Sans',
        ]);

        return $pdf->download('katalog-panijaya-' . now()->format('Ymd') . '.pdf');
    }
}
