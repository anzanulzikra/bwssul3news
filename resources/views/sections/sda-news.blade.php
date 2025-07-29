<!-- SDA News Section -->
<section class="py-24" style="background-color: #F6F8FA;" data-aos="fade-left">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-2xl font-normal text-blue-sda tracking-widest">BERITA</h2>
            <h3 class="text-3xl font-semibold text-blue-sda">SDA</h3>
        </div>
        
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            @forelse($articleSDA->take(3) as $sda)
            <a href="{{ $sda->link ?? '#' }}" target="_blank" rel="noopener noreferrer" class="block group">
                <div class="bg-white shadow-sm border border-yellow-500 p-4 transition-transform duration-200 group-hover:-translate-y-1 group-hover:shadow-lg cursor-pointer">
                <div class="space-y-4">
                    <div class="space-y-2">
                        <p class="text-xs font-bold text-blue-sda opacity-60">{{ $sda->published_at ? $sda->published_at->format('d M Y') : $sda->created_at->format('d M Y') }}</p>
                        <h4 class="text-sm font-semibold text-blue-sda leading-tight group-hover:text-blue-sda line-clamp-2">
                            {{ Str::limit($sda->title, 90) }}
                        </h4>
                    </div>
                    @if($sda->featured_image)
                    <img src="{{ asset('storage/' . $sda->featured_image) }}" alt="{{ $sda->title }}" class="w-full h-[213px] object-cover">
                    @else
                    <div class="w-full h-[213px] bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-400">No Image</span>
                    </div>
                    @endif
                </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-8">
                <p class="text-gray-500">Belum ada berita SDA tersedia</p>
            </div>
            @endforelse
        </div>
        
        <div class="text-center">
            <a href="{{ route('articles.listing') }}?category=sda" class="inline-flex items-center bg-blue-sda text-white px-6 py-3 font-medium hover:bg-blue-700 transition-colors">
                Lihat Semua
            </a>
        </div>
    </div>
</section>