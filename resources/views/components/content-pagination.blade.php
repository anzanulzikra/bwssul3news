{{-- Content Pagination Component --}}
@if($paginator->hasPages())
    <div class="flex justify-center">
        <nav class="flex items-center gap-2">
            {{-- Previous Page Link --}}
            @if($paginator->onFirstPage())
                <button class="px-3 py-2 text-gray-400 border border-gray-300 rounded-lg cursor-not-allowed" disabled>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-blue-sda border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @php
                $start = max(1, $paginator->currentPage() - 2);
                $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
            @endphp
            
            @if($start > 1)
                <a href="{{ $paginator->url(1) }}" class="px-4 py-2 text-blue-sda border border-yellow-accent rounded-lg hover:bg-yellow-50 transition-colors">1</a>
                @if($start > 2)
                    <button class="px-4 py-2 text-blue-sda border border-yellow-accent rounded-lg cursor-default">...</button>
                @endif
            @endif
            
            @for($page = $start; $page <= $end; $page++)
                @if($page == $paginator->currentPage())
                    <button class="px-4 py-2 bg-yellow-accent text-white rounded-lg font-medium">{{ $page }}</button>
                @else
                    <a href="{{ $paginator->url($page) }}" class="px-4 py-2 text-blue-sda border border-yellow-accent rounded-lg hover:bg-yellow-50 transition-colors">{{ $page }}</a>
                @endif
            @endfor
            
            @if($end < $paginator->lastPage())
                @if($end < $paginator->lastPage() - 1)
                    <button class="px-4 py-2 text-blue-sda border border-yellow-accent rounded-lg cursor-default">...</button>
                @endif
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="px-4 py-2 text-blue-sda border border-yellow-accent rounded-lg hover:bg-yellow-50 transition-colors">{{ $paginator->lastPage() }}</a>
            @endif

            {{-- Next Page Link --}}
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-blue-sda border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            @else
                <button class="px-3 py-2 text-gray-400 border border-gray-300 rounded-lg cursor-not-allowed" disabled>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 4L10 8L6 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            @endif
        </nav>
    </div>

    {{-- Page Information --}}
    <div class="text-center mt-4 text-sm text-gray-600">
        Menampilkan {{ $paginator->firstItem() }} sampai {{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
    </div>
@endif