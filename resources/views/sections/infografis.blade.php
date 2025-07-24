<!-- Infografis Section -->
<section class="py-24" style="background-color: #F6F8FA;" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center space-y-4 mb-16">
            <h2 class="text-2xl font-normal text-blue-sda tracking-widest">PENGUMUMAN & INFOGRAFIS</h2>
            <h3 class="text-3xl font-semibold text-blue-sda">BWS Sulawesi III Palu</h3>
        </div>
        
        <div class="bg-white border-2 border-blue-sda rounded-lg p-6">
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                @forelse($publikasis->where('type', 'infografis')->take(3) as $infografis)
                    <div class="cursor-pointer group" onclick="openModal('{{ $infografis->title }}', '{{ asset('storage/' . $infografis->image) }}', '{{ $infografis->link_url ?? '' }}')">
                        @if($infografis->image)
                        <img src="{{ asset('storage/' . $infografis->image) }}" alt="{{ $infografis->title }}" class="w-full h-auto rounded-lg transition-transform duration-200 group-hover:scale-105 group-hover:shadow-lg">
                        @else
                        <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center transition-transform duration-200 group-hover:scale-105">
                            <span class="text-gray-400">{{ $infografis->title }}</span>
                        </div>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8">
                        <p class="text-gray-500">Belum ada pengumuman tersedia</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center">
                <button class="inline-flex items-center bg-blue-sda text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    Lihat Semua
                </button>
            </div>
        </div>
    </div>
</section>