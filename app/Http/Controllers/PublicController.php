<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use App\Models\Produk;
use App\Models\Subsektor;
use App\Models\Article;
use App\Models\Banner;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Get active banners ordered by priority/order
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Get featured UMKMs (for example, the latest 6)
        $featuredUmkm = UMKM::with(['subsektor', 'kecamatan', 'desa'])
            ->where('status_aktif', true)
            ->where('status_verifikasi', true)
            ->latest()
            ->take(6)
            ->get();

        // Get all subsektors with UMKM counts
        $subsektors = Subsektor::withCount('umkms')->get();

        // Get recent articles
        $recentArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.home.index', compact('banners', 'featuredUmkm', 'subsektors', 'recentArticles'));
    }

}
