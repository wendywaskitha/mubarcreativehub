<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Subsektor;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['umkm', 'umkm.subsektor', 'umkm.kecamatan', 'umkm.desa'])
            ->join('umkms', 'produks.umkm_id', '=', 'umkms.id')
            ->where('umkms.status_aktif', true)
            ->where('umkms.status_verifikasi', true)
            ->select('produks.*');

        // Apply filters
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('produks.nama_produk', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('produks.deskripsi', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('umkms.nama_usaha', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('subsektor_id')) {
            $query->where('umkms.jenis_subsektor', $request->subsektor_id);
        }

        if ($request->filled('kecamatan_id')) {
            $query->where('umkms.kecamatan_id', $request->kecamatan_id);
        }

        if ($request->filled('desa_id')) {
            $query->where('umkms.desa_id', $request->desa_id);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('produks.created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('produks.nama_produk', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('produks.nama_produk', 'desc');
                break;
            case 'popular':
                $query->orderBy('produks.views', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('produks.created_at', 'desc');
                break;
        }

        $products = $query->paginate(12)->appends($request->query());

        // Get filter options
        $subsektors = Subsektor::all();
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        return view('public.produk.index', compact('products', 'subsektors', 'kecamatans', 'desas'));
    }

    public function show($id)
    {
        $produk = Produk::with(['umkm', 'umkm.subsektor', 'umkm.kecamatan', 'umkm.desa'])->findOrFail($id);

        // Update views count
        $produk->increment('views');

        // Get other products from the same UMKM
        $otherProducts = Produk::where('umkm_id', $produk->umkm_id)
            ->where('id', '!=', $produk->id)
            ->whereHas('umkm', function($query) {
                $query->where('status_aktif', true)
                      ->where('status_verifikasi', true);
            })
            ->take(4)
            ->get();

        return view('public.produk.show', compact('produk', 'otherProducts'));
    }
}
