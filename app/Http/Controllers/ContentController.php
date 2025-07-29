<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Publikasi;
use App\Services\ArticleService;
use App\Http\Controllers\Traits\HasContentListing;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    use HasContentListing;

    public function __construct(
        private readonly ArticleService $articleService
    ) {}

    // Display mixed articles listing (Internal + External)
    public function articles(Request $request)
    {
        // Get categories from service first
        $categories = $this->articleService->getArticleCategories();
        
        // If no category specified, default to first category (internal first)
        $activeCategory = $request->get('category', 'all');
        if ($activeCategory === 'all' && !empty($categories)) {
            $activeCategory = $categories[0]['slug'] ?? 'all';
        }

        // Create new request with default category
        $modifiedRequest = clone $request;
        $modifiedRequest->merge(['category' => $activeCategory]);

        // Get filtered articles from service
        $articles = $this->articleService->getFilteredArticles($modifiedRequest);

        return $this->buildContentListingResponse($articles, [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'contentType' => 'mixed',
            'pageTitle' => 'Berita',
            'pageSubtitle' => 'BWS Sulawesi III Palu',
            'breadcrumbTitle' => 'Berita',
            'sidebarTitle' => 'Kategori Berita',
            'title' => 'Berita - BWS Sulawesi III Palu'
        ]);
    }

    // Display gallery listing
    public function gallery(Request $request)
    {
        $searchTerm = $this->getSearchTerm($request);

        // Get filtered galleries
        $galleries = $this->getFilteredGalleries($searchTerm);

        // Static categories for gallery
        $categories = $this->getGalleryCategories();

        return $this->buildContentListingResponse($galleries, [
            'categories' => $categories,
            'activeCategory' => $this->getActiveCategory($request),
            'contentType' => 'gallery',
            'pageTitle' => 'Gallery',
            'pageSubtitle' => 'Dokumentasi Kegiatan',
            'breadcrumbTitle' => 'Gallery',
            'sidebarTitle' => 'Kategori Gallery',
            'title' => 'Gallery - BWS Sulawesi III Palu'
        ]);
    }

    // Display publikasi listing
    public function publikasi(Request $request)
    {
        $searchTerm = $this->getSearchTerm($request);

        // Get filtered publikasi
        $publikasis = $this->getFilteredPublikasi($searchTerm);

        // Static categories for publikasi
        $categories = $this->getPublikasiCategories();

        return $this->buildContentListingResponse($publikasis, [
            'categories' => $categories,
            'activeCategory' => $this->getActiveCategory($request),
            'contentType' => 'publikasi',
            'pageTitle' => 'Publikasi',
            'pageSubtitle' => 'Dokumen & Laporan',
            'breadcrumbTitle' => 'Publikasi',
            'sidebarTitle' => 'Kategori Publikasi',
            'title' => 'Publikasi - BWS Sulawesi III Palu'
        ]);
    }

    // Get filtered galleries
    private function getFilteredGalleries(?string $searchTerm)
    {
        $query = Gallery::query();

        // Apply search filter
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(12);
    }

    // Get filtered publikasi
    private function getFilteredPublikasi(?string $searchTerm)
    {
        $query = Publikasi::query();

        // Apply search filter
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(12);
    }

    // Get gallery categories
    private function getGalleryCategories(): array
    {
        return [
            ['name' => 'Semua Gallery', 'slug' => 'all'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan'],
            ['name' => 'Fasilitas', 'slug' => 'fasilitas'],
            ['name' => 'Acara', 'slug' => 'acara']
        ];
    }

    // Get publikasi categories
    private function getPublikasiCategories(): array
    {
        return [
            ['name' => 'Semua Publikasi', 'slug' => 'all'],
            ['name' => 'Laporan', 'slug' => 'laporan'],
            ['name' => 'Buku', 'slug' => 'buku'],
            ['name' => 'Jurnal', 'slug' => 'jurnal']
        ];
    }
}