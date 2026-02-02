<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use App\Models\Kecamatan;
use App\Models\Subsektor;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::all();
        $subsektors = Subsektor::all();

        // Get UMKMs with location data
        $umkmsWithLocation = UMKM::with(['subsektor', 'kecamatan', 'desa'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('status_aktif', true)
            ->where('status_verifikasi', true)
            ->get()
            ->map(function ($umkm) {
                // Ensure all related data is properly formatted for the frontend
                return [
                    'id' => $umkm->id,
                    'nama_usaha' => $umkm->nama_usaha,
                    'nama_pemilik' => $umkm->nama_pemilik,
                    'alamat_usaha' => $umkm->alamat_usaha,
                    'latitude' => $umkm->latitude,
                    'longitude' => $umkm->longitude,
                    'no_telp' => $umkm->no_telp,
                    'kecamatan_id' => $umkm->kecamatan_id,
                    'desa_id' => $umkm->desa_id,
                    'subsektor_id' => $umkm->subsektor_id,
                    'subsektor' => $umkm->subsektor ? [
                        'id' => $umkm->subsektor->id,
                        'nama_subsektor' => $umkm->subsektor->nama_subsektor,
                        'icon' => $umkm->subsektor->icon,
                        'color_code' => $umkm->subsektor->color_code,
                    ] : null,
                    'kecamatan' => $umkm->kecamatan ? [
                        'id' => $umkm->kecamatan->id,
                        'nama_kecamatan' => $umkm->kecamatan->nama_kecamatan,
                    ] : null,
                    'desa' => $umkm->desa ? [
                        'id' => $umkm->desa->id,
                        'nama_desa' => $umkm->desa->nama_desa,
                    ] : null,
                ];
            });

        return view('public.map.index', compact('kecamatans', 'subsektors', 'umkmsWithLocation'));
    }
}
