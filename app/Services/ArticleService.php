<?php

namespace App\Services;

use App\Models\Article;
use App\Models\ArticleEksternal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    private const CHAR_LIMIT = 190;
    private const PER_PAGE = 9;

    /**
     * Get filtered and paginated articles (internal + external)
     */
    public function getFilteredArticles(Request $request): LengthAwarePaginator
    {
        $categoryFilter = $request->get('category', 'all');
        $searchTerm = $request->get('search');
        
        $articles = collect();
        
        // Get internal articles if needed
        if ($this->shouldIncludeInternal($categoryFilter)) {
            $internalArticles = $this->getInternalArticles($categoryFilter, $searchTerm);
            $articles = $articles->merge($internalArticles);
        }
        
        // Get external articles if needed
        if ($this->shouldIncludeExternal($categoryFilter)) {
            $externalArticles = $this->getExternalArticles($categoryFilter, $searchTerm);
            $articles = $articles->merge($externalArticles);
        }
        
        // Sort by published date
        $articles = $this->sortArticlesByDate($articles);
        
        return $this->paginateArticles($articles, $request);
    }

    // Get categories for sidebar with hierarchy
    public function getArticleCategories(): array
    {
        $categories = [];

        // Add internal categories first (BWS Sulawesi III Palu categories)
        $internalCategories = Category::whereHas('articles', fn($q) => $q->where('status', 'published'))
            ->orderBy('name')
            ->get();
        
        foreach ($internalCategories as $category) {
            $categories[] = [
                'name' => $category->name,
                'slug' => $category->slug,
                'type' => 'internal'
            ];
        }

        // Add external categories (Kementrian PU, SDA)
        $externalCategories = Category::whereHas('articleEksternals', fn($q) => $q->where('status', 'published'))
            ->orderBy('name')
            ->get();
        
        foreach ($externalCategories as $category) {
            $categories[] = [
                'name' => $category->name,
                'slug' => $category->slug,
                'type' => 'external'
            ];
        }

        return $categories;
    }

    // Check if should include internal articles
    private function shouldIncludeInternal(string $categoryFilter): bool
    {
        // Always include internal if no specific category filter
        if ($categoryFilter === 'all') {
            return true;
        }
        
        // Check if category exists in internal articles
        return Category::where('slug', $categoryFilter)
            ->whereHas('articles', fn($q) => $q->where('status', 'published'))
            ->exists();
    }

    // Check if should include external articles
    private function shouldIncludeExternal(string $categoryFilter): bool
    {
        // Always include external if no specific category filter
        if ($categoryFilter === 'all') {
            return true;
        }
        
        // Check if category exists in external articles
        return Category::where('slug', $categoryFilter)
            ->whereHas('articleEksternals', fn($q) => $q->where('status', 'published'))
            ->exists();
    }

    /**
     * Get internal articles with filters
     */
    private function getInternalArticles(string $categoryFilter, ?string $searchTerm)
    {
        $query = Article::with(['category', 'tags'])
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= ?', [self::CHAR_LIMIT]);

        // Apply category filter
        if ($categoryFilter !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('slug', $categoryFilter));
        }

        // Apply search filter
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('content', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', fn($catQuery) => 
                      $catQuery->where('name', 'like', "%{$searchTerm}%"));
            });
        }

        return $query->get()->map(function($article) {
            $article->article_type = 'internal';
            return $article;
        });
    }

    /**
     * Get external articles with filters
     */
    private function getExternalArticles(string $categoryFilter, ?string $searchTerm)
    {
        $query = ArticleEksternal::with(['category'])
            ->where('status', 'published')
            ->whereRaw('CHAR_LENGTH(title) <= ?', [self::CHAR_LIMIT]);

        // Apply category filter
        if ($categoryFilter !== 'all') {
            $query->whereHas('category', fn($q) => $q->where('slug', $categoryFilter));
        }

        // Apply search filter
        if ($searchTerm) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', fn($catQuery) => 
                      $catQuery->where('name', 'like', "%{$searchTerm}%"));
            });
        }

        return $query->get()->map(function($article) {
            $article->article_type = 'external';
            return $article;
        });
    }

    /**
     * Sort articles by published date
     */
    private function sortArticlesByDate($articles)
    {
        return $articles->sortByDesc(function($article) {
            return $article->published_at ?? $article->created_at;
        });
    }

    /**
     * Create paginated results
     */
    private function paginateArticles($articles, Request $request): LengthAwarePaginator
    {
        $totalCount = $articles->count();
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * self::PER_PAGE;
        $items = $articles->slice($offset, self::PER_PAGE)->values();

        $paginator = new LengthAwarePaginator(
            $items,
            $totalCount,
            self::PER_PAGE,
            $currentPage,
            [
                'path' => $request->url(),
                'pageName' => 'page',
            ]
        );

        $paginator->appends($request->except('page'));
        
        return $paginator;
    }
}