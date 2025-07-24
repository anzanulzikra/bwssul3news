<!-- Hero Section -->
<section class="relative bg-white overflow-hidden min-h-screen lg:h-screen" data-aos="fade-up">
    <div class="grid grid-cols-1 lg:grid-cols-2 h-full">
        <!-- Hero Content -->
        <div class="px-6 sm:px-8 lg:px-8 py-12 lg:py-16 flex items-center">
            <div class="max-w-2xl mx-auto lg:mx-0 space-y-6 lg:space-y-8">
                <div class="space-y-4">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-blue-sda leading-tight">
                        #MENGELOLA AIR UNTUK NEGERI
                    </h1>
                    <p id="heroSubtitle" class="text-lg sm:text-xl lg:text-2xl font-medium text-gray-600 leading-relaxed">
                        @if($sliderWebs->count() > 0)
                            {{ $sliderWebs->first()->title }}
                        @else
                            Siap Membangun Negeri Untuk Rakyat
                        @endif
                    </p>
                </div>
                
                <div class="space-y-4 lg:space-y-6">
                    <div class="space-y-2">
                        <h2 class="text-xl lg:text-2xl font-semibold text-blue-sda">BWS Sulawesi III Palu</h2>
                        <p class="text-base lg:text-xl text-blue-sda">Jl. Abdul Rachman Saleh No. 230 Palu, Sulawesi Tengah</p>
                    </div>
                    
                    <button class="inline-flex items-center gap-2 bg-yellow-accent text-blue-sda px-4 lg:px-6 py-3 rounded-lg font-medium hover:bg-yellow-500 transition-colors">
                        <img src="{{ asset('assets/icons/location.svg') }}" alt="Location" class="w-5 h-5">
                        Kunjungi Balai Kami
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Hero Image Carousel -->
        <div class="relative w-full h-64 lg:h-full overflow-hidden">
            @if($sliderWebs->count() > 0)
                <div id="heroCarousel" class="flex transition-transform duration-500 ease-in-out h-full">
                    @foreach($sliderWebs as $slider)
                    <div class="w-full h-full flex-shrink-0">
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
                
                <!-- Carousel Indicators -->
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                    @foreach($sliderWebs as $index => $slider)
                    <button class="carousel-indicator w-4 h-4 {{ $index === 0 ? 'bg-yellow-accent' : 'bg-blue-sda bg-opacity-60' }} rounded-full transition-all duration-300" data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
                
                <!-- Navigation Arrows -->
                <button class="absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white bg-opacity-80 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all duration-300" id="prevBtn">
                    <img src="{{ asset('assets/icons/arrow-left.svg') }}" alt="Previous" class="w-5 h-5">
                </button>
                <button class="absolute right-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-white bg-opacity-80 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all duration-300" id="nextBtn">
                    <img src="{{ asset('assets/icons/arrow-right.svg') }}" alt="Next" class="w-5 h-5">
                </button>
            @else
                <div class="w-full h-full flex items-center justify-center bg-gray-200">
                    <p class="text-gray-500">No slider images available</p>
                </div>
            @endif
        </div>
    </div>
</section>