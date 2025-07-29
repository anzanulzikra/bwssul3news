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
        $settings = SettingWeb::whereIn('name', [
            'address', 'contact_phone', 'contact_fax', 'contact_email',
            'social_facebook', 'social_instagram', 'social_youtube', 'sosial_x', 'copyright'
        ])->get();
        
        if ($settings->isEmpty()) {
            return null;
        }

        return [
            'address' => $settings->where('name', 'address')->first()->value ?? 'Jl. Abdurachman Saleh No. 230 Palu Provinsi Sulawesi Tengah, Indonesia',
            'phone' => $settings->where('name', 'contact_phone')->first()->value ?? 'Telp. (0451) 482147',
            'fax' => $settings->where('name', 'contact_fax')->first()->value ?? 'Fax. (0451) 482101',
            'email' => $settings->where('name', 'contact_email')->first()->value ?? null,
            'social_facebook' => $settings->where('name', 'social_facebook')->first()->value ?? '#',
            'social_instagram' => $settings->where('name', 'social_instagram')->first()->value ?? '#',
            'social_youtube' => $settings->where('name', 'social_youtube')->first()->value ?? '#',
            'social_x' => $settings->where('name', 'sosial_x')->first()->value ?? '#',
            'copyright' => $settings->where('name', 'copyright')->first()->value ?? null
        ];
    }

    // Get website settings for SEO and general info
    protected function getWebSettings(): array
    {
        $settings = SettingWeb::whereIn('name', [
            'site_title', 'site_description', 'map', 'visitor_counter_code'
        ])->get();

        return [
            'site_title' => $settings->where('name', 'site_title')->first()->value ?? 'BWS Sulawesi III Palu',
            'site_description' => $settings->where('name', 'site_description')->first()->value ?? 'Website resmi Balai Wilayah Sungai Sulawesi III Palu. Informasi, berita, layanan, dan publikasi seputar pengelolaan sumber daya air di Sulawesi Tengah.',
            'map' => $settings->where('name', 'map')->first()->value ?? null,
            'visitor_counter_code' => $settings->where('name', 'visitor_counter_code')->first()->value ?? null
        ];
    }
}