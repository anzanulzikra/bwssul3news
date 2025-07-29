<?php

namespace App\Http\Controllers;

use App\Models\ArticleEksternal;
use App\Models\Category;
use App\Http\Controllers\Traits\HasContentListing;
use Illuminate\Http\Request;

class ExternalArticleController extends Controller
{
    use HasContentListing;

    // Display listing of external articles (Kementrian PU & SDA)
    public function index(Request $request)
    {
        $activeCategory = $this->getActiveCategory($request);
        $searchTerm = $this->getSearchTerm($request);

        // Get filtered external articles
        $articles = $this->getFilteredExternalArticles($activeCategory, $searchTerm);

        // Get categories for sidebar
        $categories = $this->getExternalArticleCategories();

        return $this->buildContentListingResponse($articles, [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'contentType' => 'article-eksternal',
            'pageTitle' => 'Berita Eksternal',
            'pageSubtitle' => 'Kementrian PU & SDA',
            'breadcrumbTitle' => 'Berita Eksternal',
            'sidebarTitle' => 'Kategori Berita',
            'title' => 'Berita Eksternal - BWS Sulawesi III Palu'
        ]);
    }

    // Get filtered external articles
    private function getFilteredExternalArticles(string $categoryFilter, ?string $searchTerm)
    {
        $query = ArticleEksternal::with(['category'])
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= 190');

        // Apply category filter
        if ($categoryFilter !== 'all') {
            $query->whereHas('category', function($q) use ($categoryFilter) {
                $q->where('slug', $categoryFilter);
            });
        }

        // Apply search filter
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', function($catQuery) use ($searchTerm) {
                      $catQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        return $query->orderBy('published_at', 'desc')->paginate(12);
    }

    // Get categories for external articles
    private function getExternalArticleCategories(): array
    {
        $categories = $this->buildBasicCategories('Semua Berita');

        // Add categories that have external articles
        $externalCategories = Category::whereHas('articleEksternals', function($q) {
            $q->where('status', 'published');
        })->get();

        foreach ($externalCategories as $category) {
            $categories[] = [
                'name' => $category->name,
                'slug' => $category->slug
            ];
        }

        return $categories;
    }
}