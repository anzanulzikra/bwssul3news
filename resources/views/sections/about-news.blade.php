<!-- About & News Section -->
<section class="bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('assets/images/section-bg.jpg') }}');" data-aos="fade-right">
    <!-- About Section -->
    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <img src="{{ asset('assets/images/img-section2.jpg') }}" alt="About Image" class="w-full h-auto rounded-lg">
                </div>
                
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h2 class="text-2xl font-normal text-blue-sda tracking-widest">TENTANG KAMI</h2>
                        <h3 class="text-3xl font-semibold text-blue-sda">BWS Sulawesi III Palu</h3>
                        <p class="text-xl text-blue-sda leading-relaxed">
                            Mempunyai tugas melaksanakan pengelolaan sumber daya air di wilayah sungai yang meliputi perencanaan, pelaksanaan konstruksi, operasi dan pemeliharaan dalam rangka konservasi dan pendayagunaan sumber daya air dan pengendalian daya rusak air pada sungai, danau, waduk, bendungan dan tampungan air lainnya, irigasi, air tanah, air baku, rawa, tambak dan pantai.
                        </p>
                    </div>
                    
                    <button class="inline-flex items-center gap-2 border-2 border-zinc-500 text-blue-sda px-6 py-3 rounded-lg font-medium hover:bg-zinc-50 transition-colors">
                        <img src="{{ asset('assets/icons/contact.svg') }}" alt="Contact" class="w-5 h-5">
                        Kontak Kami
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-4 mb-16">
                <h2 class="text-2xl font-normal text-blue-sda tracking-widest">BERITA TERKINI</h2>
                <h3 class="text-3xl font-semibold text-blue-sda">BWS Sulawesi III Palu</h3>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                @forelse($articles->take(3) as $article)
                <a href="{{ route('article.detail', $article->slug) }}" class="block group">
                    <div class="bg-white rounded-lg shadow-sm border border-yellow-500 p-4 transition-transform duration-200 group-hover:-translate-y-1 group-hover:shadow-lg cursor-pointer">
                        <div class="space-y-4">
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-blue-sda opacity-60">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</p>
                                <h4 class="text-sm font-semibold text-blue-sda leading-tight group-hover:text-blue-sda line-clamp-2">
                                    {{ Str::limit($article->title, 90) }}
                                </h4>
                            </div>
                            @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-[213px] object-cover rounded-lg">
                            @else
                            <div class="w-full h-[213px] bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500">Belum ada berita tersedia</p>
                </div>
                @endforelse
            </div>
            
            <div class="text-center">
                <button class="inline-flex items-center border-2 border-zinc-500 text-blue-sda px-6 py-3 rounded-lg font-medium hover:bg-zinc-50 transition-colors">
                    Lihat Semua
                </button>
            </div>
        </div>
    </div>
</section>