{{-- Content Sidebar Component --}}
<aside class="w-full lg:w-[280px] order-1">
    <div class="rounded-xl p-6 lg:sticky lg:top-6" style="background-color: #FDEDD3;">
        <div class="space-y-6">
            <div>
                <h3 class="text-blue-sda font-semibold text-lg mb-4">{{ $sidebarTitle }}</h3>
                <div class="space-y-2">
                    @foreach($categories as $category)
                        {{-- Category item --}}
                        <div class="{{ $activeCategory === $category['slug'] ? 'bg-yellow-accent text-white' : 'text-blue-sda hover:bg-yellow-200' }} px-3 py-2 rounded-lg text-sm {{ $activeCategory === $category['slug'] ? 'font-medium' : '' }} cursor-pointer transition-colors"
                             onclick="filterByCategory('{{ $category['slug'] }}')">
                            {{ $category['name'] }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</aside>

@push('scripts')
<script>
function filterByCategory(categorySlug) {
    // Update URL dengan parameter kategori
    const url = new URL(window.location);
    if (categorySlug === 'all') {
        url.searchParams.delete('category');
    } else {
        url.searchParams.set('category', categorySlug);
    }
    url.searchParams.delete('page'); // Reset pagination saat filter berubah
    window.location.href = url.toString();
}
</script>
@endpush