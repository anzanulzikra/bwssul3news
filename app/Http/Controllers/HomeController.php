<?php

namespace App\Http\Controllers;

use App\Models\SliderWeb;
use App\Models\Article;
use App\Models\ArticleEksternal;
use App\Models\Publikasi;
use App\Models\EMonitoring;
use App\Models\PartnersLogo;
use App\Models\SettingWeb;


class HomeController extends Controller
{
    public function index()
    {
        // Hero carousel images
        $sliderWebs = SliderWeb::orderBy('order')->limit(10)->get();

        // Berita internal BWS (published only)
        $articles = Article::with(['category', 'tags', 'images'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        // Berita Kementrian PU (artikel eksternal dengan kategori Kementrian PU)
        $articleKementrianPU = ArticleEksternal::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'Kementrian PU');
            })
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        // Berita SDA (artikel eksternal dengan kategori SDA)
        $articleSDA = ArticleEksternal::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'SDA');
            })
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();

        // Data untuk section video dan infografis
        $publikasis = Publikasi::orderBy('created_at', 'desc')->limit(10)->get();
        $eMonitorings = EMonitoring::orderBy('last_updated', 'desc')->limit(10)->get();
        $partnersLogos = PartnersLogo::orderBy('order')->limit(10)->get();
        $settingWebs = SettingWeb::orderBy('name')->limit(20)->get();

        return view('index', compact(
            'sliderWebs', 
            'articles', 
            'articleKementrianPU', 
            'articleSDA',
            'publikasis', 
            'eMonitorings', 
            'partnersLogos', 
            'settingWebs'
        ));
    }

    //Menampilkan halaman detail artikel
    public function articleDetail($slug)
    {
        // Ambil artikel berdasarkan slug (published only)
        $article = Article::with(['category', 'tags', 'images'])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // Artikel terkait dari kategori yang sama (exclude artikel saat ini)
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->when($article->category_id, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        return view('article.detail', compact('article', 'relatedArticles'));
    }
}