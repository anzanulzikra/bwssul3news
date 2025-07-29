{{-- Content Listing Page --}}
@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav class="flex items-center gap-2 text-sm">
            <div class="flex items-center gap-1">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.9068 5.57998L9.28676 1.88665C8.57343 1.31331 7.4201 1.31331 6.71343 1.87998L2.09343 5.57998C1.57343 5.99331 1.2401 6.86665 1.35343 7.51998L2.2401 12.8266C2.4001 13.7733 3.30676 14.54 4.26676 14.54H11.7334C12.6868 14.54 13.6001 13.7666 13.7601 12.8266L14.6468 7.51998C14.7534 6.86665 14.4201 5.99331 13.9068 5.57998ZM8.0001 10.3333C7.0801 10.3333 6.33343 9.58665 6.33343 8.66665C6.33343 7.74665 7.0801 6.99998 8.0001 6.99998C8.9201 6.99998 9.66676 7.74665 9.66676 8.66665C9.66676 9.58665 8.9201 10.3333 8.0001 10.3333Z" fill="#FFB703"/>
                </svg>
                <a href="{{ route('home') }}" class="text-yellow-accent font-normal hover:text-yellow-600 transition-colors">Beranda</a>
            </div>
            <span class="text-blue-sda">/</span>
            <span class="text-blue-sda font-normal">{{ $breadcrumbTitle }}</span>
            @if(request('category') && request('category') !== 'all')
                <span class="text-blue-sda">/</span>
                <span class="text-yellow-accent font-normal">
                    {{ collect($categories)->firstWhere('slug', request('category'))['name'] ?? ucfirst(request('category')) }}
                </span>
            @endif
        </nav>
    </div>

    <!-- Content Container with Sidebar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Navigation -->
            @include('components.content-sidebar', [
                'sidebarTitle' => $sidebarTitle,
                'categories' => $categories,
                'activeCategory' => $activeCategory
            ])

            <!-- Main Content Area -->
            <div class="flex-1 order-2">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold text-blue-sda mb-4">{{ $pageTitle }}</h1>
                    <h2 class="text-xl md:text-2xl lg:text-3xl font-medium text-blue-sda">
                        @if($activeCategory === 'all')
                            BWS Sulawesi III Palu
                        @elseif($activeCategory === 'internal')
                            Internal BWS Sulawesi III Palu
                        @elseif($activeCategory === 'external')
                            Eksternal
                        @else
                            {{ collect($categories)->firstWhere('slug', $activeCategory)['name'] ?? 'BWS Sulawesi III Palu' }}
                        @endif
                    </h2>
                    
                    @if(isset($totalItems) && $totalItems > 0)
                        <p class="text-gray-600 mt-4">{{ $totalItems }} berita tersedia</p>
                    @endif
                </div>

                <!-- Content Grid -->
                @include('components.content-grid', [
                    'items' => $items,
                    'contentType' => $contentType
                ])

                <!-- Pagination -->
                @if(isset($items) && method_exists($items, 'hasPages'))
                    @include('components.content-pagination', ['paginator' => $items])
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add loading state for filters
    document.querySelectorAll('[onclick*="filterByCategory"]').forEach(function(element) {
        element.addEventListener('click', function() {
            this.innerHTML = 'Loading...';
        });
    });
});
</script>
@endpush