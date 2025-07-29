<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Http\Controllers\Traits\HasContentListing;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use HasContentListing;

    // Display listing of internal articles
    public function index(Request $request)
    {
        $activeCategory = $this->getActiveCategory($request);
        $searchTerm = $this->getSearchTerm($request);

        // Build query for internal articles
        $articles = $this->getFilteredInternalArticles($activeCategory, $searchTerm);

        // Get categories for sidebar
        $categories = $this->getInternalArticleCategories();

        return $this->buildContentListingResponse($articles, [
            'categories' => $categories,
            'activeCategory' => $activeCategory,
            'contentType' => 'article-internal',
            'pageTitle' => 'Berita Internal',
            'pageSubtitle' => 'BWS Sulawesi III Palu',
            'breadcrumbTitle' => 'Berita Internal',
            'sidebarTitle' => 'Kategori Berita',
            'title' => 'Berita Internal - BWS Sulawesi III Palu'
        ]);
    }

    // Get filtered internal articles
    private function getFilteredInternalArticles(string $categoryFilter, ?string $searchTerm)
    {
        $query = Article::with(['category', 'tags'])
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
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', function($catQuery) use ($searchTerm) {
                      $catQuery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }

        return $query->orderBy('published_at', 'desc')->paginate(12);
    }

    // Get categories for internal articles
    private function getInternalArticleCategories(): array
    {
        $categories = $this->buildBasicCategories('Semua Berita');

        // Add categories that have internal articles
        $internalCategories = Category::whereHas('articles', function($q) {
            $q->where('status', 'published');
        })->get();

        foreach ($internalCategories as $category) {
            $categories[] = [
                'name' => $category->name,
                'slug' => $category->slug
            ];
        }

        return $categories;
    }

}