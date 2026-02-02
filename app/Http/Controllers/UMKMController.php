<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use App\Models\Kecamatan;
use App\Models\Subsektor;
use App\Models\Desa;
use Illuminate\Http\Request;

class UMKMController extends Controller
{
    public function index(Request $request)
    {
        $query = UMKM::with(['subsektor', 'kecamatan', 'desa']);

        // Apply filters if provided
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan_id', $request->kecamatan);
        }

        if ($request->filled('desa')) {
            $query->where('desa_id', $request->desa);
        }

        if ($request->filled('subsektor')) {
            $query->where('subsektor_id', $request->subsektor);
        }

        // Apply search if provided (support both 'q' and 'search' parameters)
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_usaha', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nama_pemilik', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('produks', function($q) use ($searchTerm) {
                      $q->where('nama_produk', 'LIKE', "%{$searchTerm}%");
                  });
            });
        } elseif ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_usaha', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nama_pemilik', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('produks', function($q) use ($searchTerm) {
                      $q->where('nama_produk', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Apply sorting
        switch ($request->sort) {
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'nama':
                $query->orderBy('nama_usaha', 'asc');
                break;
            case 'populer':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Default sorting
        }

        $umkms = $query->paginate(12)->appends(request()->query());

        $kecamatans = Kecamatan::all();
        $subsektors = Subsektor::all();

        // Get desas based on selected kecamatan
        $desas = collect();
        if ($request->filled('kecamatan')) {
            $desas = Desa::where('kecamatan_id', $request->kecamatan)->get();
        } else {
            $desas = Desa::all();
        }

        return view('public.umkm.index', compact('umkms', 'kecamatans', 'subsektors', 'desas'));
    }

    public function show($id)
    {
        $umkm = UMKM::with(['subsektor', 'kecamatan', 'desa', 'produks'])->findOrFail($id);

        // Get related UMKMs (same subsector, different UMKM)
        $relatedUmkm = UMKM::where('subsektor_id', $umkm->subsektor_id)
            ->where('id', '!=', $umkm->id)
            ->where('status_aktif', true)
            ->where('status_verifikasi', true)
            ->take(4)
            ->get();

        return view('public.umkm.show', compact('umkm', 'relatedUmkm'));
    }

    public function search(Request $request)
    {
        $query = UMKM::with(['subsektor', 'kecamatan', 'desa']);

        // Apply search if provided
        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_usaha', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('nama_pemilik', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('produks', function($q) use ($searchTerm) {
                      $q->where('nama_produk', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // Apply filters if provided
        if ($request->filled('kecamatan')) {
            $query->where('kecamatan_id', $request->kecamatan);
        }

        if ($request->filled('desa')) {
            $query->where('desa_id', $request->desa);
        }

        if ($request->filled('subsektor')) {
            $query->where('subsektor_id', $request->subsektor);
        }

        // Apply sorting
        switch ($request->sort) {
            case 'terbaru':
                $query->orderBy('created_at', 'desc');
                break;
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'nama':
                $query->orderBy('nama_usaha', 'asc');
                break;
            case 'populer':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Default sorting
        }

        $umkms = $query->paginate(12)->appends(request()->query());

        $kecamatans = Kecamatan::all();
        $subsektors = Subsektor::all();

        // Get desas based on selected kecamatan
        $desas = collect();
        if ($request->filled('kecamatan')) {
            $desas = Desa::where('kecamatan_id', $request->kecamatan)->get();
        } else {
            $desas = Desa::all();
        }

        return view('public.umkm.index', compact('umkms', 'kecamatans', 'subsektors', 'desas'));
    }
}
