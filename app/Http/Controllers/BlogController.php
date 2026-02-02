<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $articles = $query->latest('published_at')->paginate(9);

        // Get category counts for sidebar
        $categories = Article::where('status', 'published')
            ->selectRaw('kategori, count(*) as count')
            ->groupBy('kategori')
            ->pluck('count', 'kategori');

        // Get recent articles for sidebar
        $recentArticles = Article::where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('public.blog.index', compact('articles', 'categories', 'recentArticles'));
    }

    public function show($id)
    {
        $article = Article::where('status', 'published')->findOrFail($id);

        // Get related articles (same category, different articles)
        $relatedArticles = Article::where('kategori', $article->kategori)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->take(3)
            ->get();

        // Get previous and next articles for navigation
        $previousArticle = Article::where('status', 'published')
            ->where('id', '<', $article->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Article::where('status', 'published')
            ->where('id', '>', $article->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('public.blog.show', compact('article', 'relatedArticles', 'previousArticle', 'nextArticle'));
    }
}
