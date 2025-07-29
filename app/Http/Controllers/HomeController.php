<?php

namespace App\Http\Controllers;

use App\Models\SliderWeb;
use App\Models\Article;
use App\Models\ArticleEksternal;
use App\Models\Publikasi;
use App\Models\EMonitoring;
use App\Models\PartnersLogo;
use App\Models\SettingWeb;
use App\Http\Controllers\Traits\HasContentListing;

class HomeController extends Controller
{
    use HasContentListing;
    // Display the homepage
    public function index()
    {
        // Get all homepage data
        $data = $this->getHomepageData();

        return view('index', $data);
    }

    // Display article detail page
    public function articleDetail(string $slug)
    {
        // Get article by slug (published only)
        $article = Article::with(['category', 'tags', 'images'])
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        // Get related articles from same category
        $relatedArticles = $this->getRelatedArticles($article);

        // Get footer info
        $footerInfo = $this->getFooterInfo();

        return view('article.detail', compact('article', 'relatedArticles', 'footerInfo'));
    }

    // Get all data needed for homepage
    private function getHomepageData(): array
    {
        return [
            'sliderWebs' => $this->getSliderImages(),
            'articles' => $this->getInternalArticles(),
            'articleKementrianPU' => $this->getKementrianPUArticles(),
            'articleSDA' => $this->getSDAArticles(),
            'publikasis' => $this->getPublikasi(),
            'eMonitorings' => $this->getEMonitorings(),
            'partnersLogos' => $this->getPartnersLogos(),
            'settingWebs' => $this->getSettingWebs(),
            'footerInfo' => $this->getFooterInfo()
        ];
    }

    // Get slider images for hero carousel
    private function getSliderImages()
    {
        return SliderWeb::orderBy('order')->limit(10)->get();
    }

    // Get internal BWS articles
    private function getInternalArticles()
    {
        return Article::with(['category', 'tags'])
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= 190')
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();
    }

    // Get Kementrian PU articles
    private function getKementrianPUArticles()
    {
        return ArticleEksternal::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'LIKE', '%Kementrian PU%')
                      ->orWhere('name', 'LIKE', '%Kementerian PU%');
            })
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= 190')
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();
    }

    // Get SDA articles
    private function getSDAArticles()
    {
        return ArticleEksternal::with('category')
            ->whereHas('category', function($query) {
                $query->where('name', 'SDA');
            })
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= 190')
            ->orderBy('published_at', 'desc')
            ->limit(10)
            ->get();
    }

    // Get publikasi data
    private function getPublikasi()
    {
        return Publikasi::orderBy('created_at', 'desc')->limit(10)->get();
    }

    // Get e-monitoring data
    private function getEMonitorings()
    {
        return EMonitoring::orderBy('last_updated', 'desc')->limit(10)->get();
    }

    // Get partners logos
    private function getPartnersLogos()
    {
        return PartnersLogo::orderBy('order')->limit(10)->get();
    }

    // Get website settings
    private function getSettingWebs()
    {
        return SettingWeb::orderBy('name')->limit(20)->get();
    }

    // Get related articles for article detail
    private function getRelatedArticles(Article $article)
    {
        return Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= 190')
            ->when($article->category_id, function ($query, $categoryId) {
                return $query->where('category_id', $categoryId);
            })
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();
    }
}