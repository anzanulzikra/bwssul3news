<!-- Video Section -->
<section class="py-24" style="background-color: #F6F8FA;" data-aos="fade-left">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-2xl font-normal text-blue-sda tracking-widest">VIDEO</h2>
            <h3 class="text-3xl font-semibold text-blue-sda">BWS Sulawesi III Palu</h3>
        </div>
        
        <div class="border-2 rounded-lg p-6" style="border-color: #FFB703;">
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                @forelse($publikasis->where('type', 'video')->take(3) as $video)
                <a href="{{ $video->link_url ?? '#' }}" target="_blank" rel="noopener noreferrer" class="block group">
                    <div class="rounded-2xl p-4 transition-transform duration-200 group-hover:-translate-y-1 group-hover:shadow-lg cursor-pointer" style="background-color: #FFE9B1;">
                        @if($video->image)
                        <img src="{{ asset('storage/' . $video->image) }}" alt="{{ $video->title }}" class="w-full h-56 object-cover rounded-t-lg mb-4">
                        @else
                        <div class="w-full h-56 bg-gray-200 rounded-t-lg mb-4 flex items-center justify-center">
                            <span class="text-gray-400">No Image</span>
                        </div>
                        @endif
                        <h4 class="text-base text-blue-sda leading-relaxed group-hover:text-blue-sda line-clamp-2">
                            {{ Str::limit($video->title, 90) }}
                        </h4>
                    </div>
                </a>
                @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500">Belum ada video tersedia</p>
                </div>
                @endforelse
            </div>
            
            <div class="text-center">
                <button class="inline-flex items-center bg-yellow-500 text-blue-sda px-6 py-3 rounded-lg font-medium hover:bg-yellow-600 transition-colors">
                    Lihat Semua
                </button>
            </div>
        </div>
    </div>
</section>