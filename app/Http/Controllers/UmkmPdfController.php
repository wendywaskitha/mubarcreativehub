<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UmkmPdfController extends Controller
{
    public function export()
    {
        $umkms = UMKM::with(['kecamatan', 'desa', 'subsektor'])->get();

        $pdf = Pdf::loadView('pdf.umkm-report', compact('umkms'));
        return $pdf->download('laporan-umkm-' . now()->format('Y-m-d') . '.pdf');
    }
    
    public function preview()
    {
        $umkms = UMKM::with(['kecamatan', 'desa', 'subsektor'])->get();
        
        return view('pdf.umkm-report', compact('umkms'));
    }
}