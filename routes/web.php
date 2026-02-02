<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UMKMController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MapController;

// Public routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/umkm', [UMKMController::class, 'index'])->name('umkm.index');
Route::get('/umkm/search', [UMKMController::class, 'search'])->name('umkm.search');
Route::get('/umkm/{id}', [UMKMController::class, 'show'])->name('umkm.show');
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/map', [MapController::class, 'index'])->name('map.index');

// PDF Export routes
Route::get('/umkm/pdf/export', function () {
    $umkms = \App\Models\UMKM::with(['kecamatan', 'desa', 'subsektor'])->get();
    $signatureData = session('pdf_signature_data', []);
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.umkm-report', compact('umkms', 'signatureData'));
    session()->forget('pdf_signature_data'); // Clear the session data after using it
    return $pdf->download('laporan-umkm-' . now()->format('Y-m-d') . '.pdf');
})->name('umkm.pdf.export');

Route::get('/umkm/pdf/preview', function () {
    $umkms = \App\Models\UMKM::with(['kecamatan', 'desa', 'subsektor'])->get();
    $signatureData = session('pdf_signature_data', []);
    return view('pdf.umkm-report', compact('umkms', 'signatureData'));
})->name('umkm.pdf.preview');
