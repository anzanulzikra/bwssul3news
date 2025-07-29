<?php

namespace App\Http\Controllers\Traits;

use App\Models\SettingWeb;
use Illuminate\Http\Request;

trait HasContentListing
{
    // Build standardized content listing response
    protected function buildContentListingResponse($items, array $config)
    {
        // Default configuration
        $defaultConfig = [
            'categories' => [],
            'activeCategory' => 'all', 
            'contentType' => 'mixed',
            'pageTitle' => 'Content',
            'pageSubtitle' => 'BWS Sulawesi III Palu',
            'breadcrumbTitle' => 'Content',
            'sidebarTitle' => 'Categories',
            'title' => 'Content - BWS Sulawesi III Palu'
        ];

        // Merge with provided config
        $config = array_merge($defaultConfig, $config);

        // Add computed values
        $config['totalItems'] = method_exists($items, 'total') ? $items->total() : $items->count();
        $config['items'] = $items;
        $config['footerInfo'] = $this->getFooterInfo();

        return view('pages.content-listing', $config);
    }

    // Get active category from request
    protected function getActiveCategory(Request $request): string
    {
        return $request->get('category', 'all');
    }

    // Get search term from request
    protected function getSearchTerm(Request $request): ?string
    {
        return $request->filled('search') ? $request->get('search') : null;
    }

    // Build standard categories array
    protected function buildBasicCategories(string $allLabel = 'Semua'): array
    {
        return [
            ['name' => $allLabel, 'slug' => 'all']
        ];
    }

    // Get footer information from settings
    protected function getFooterInfo(): ?array
    {
        $settings = SettingWeb::whereIn('name', ['address', 'phone', 'fax'])->get();
        
        if ($settings->isEmpty()) {
            return null;
        }

        return [
            'address' => $settings->where('name', 'address')->first()->value ?? 'Jl. Abdurachman Saleh No. 230 Palu Provinsi Sulawesi Tengah, Indonesia',
            'phone' => $settings->where('name', 'phone')->first()->value ?? 'Telp. (0451) 482147',
            'fax' => $settings->where('name', 'fax')->first()->value ?? 'Fax. (0451) 482101'
        ];
    }
}