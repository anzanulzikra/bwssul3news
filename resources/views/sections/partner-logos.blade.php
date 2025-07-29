<!-- Partner Logos Carousel Section -->
<section class="py-16 bg-gray-100" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($partnersLogos->count() > 0)
            <!-- Partner Logos Carousel -->
            <div class="relative overflow-hidden py-8">
                <!-- Navigation Arrows -->
                <button class="absolute left-2 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all duration-300 z-10" id="partnerPrevBtn">
                    <svg class="w-4 h-4 text-blue-sda" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <button class="absolute right-2 top-1/2 transform -translate-y-1/2 w-8 h-8 bg-white bg-opacity-80 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all duration-300 z-10" id="partnerNextBtn">
                    <svg class="w-4 h-4 text-blue-sda" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <!-- Mobile Carousel (2 logos per slide) -->
                <div id="partnerLogoCarousel" class="flex transition-transform duration-500 ease-in-out sm:hidden">
                    @foreach($partnersLogos->chunk(2) as $chunk)
                    <div class="flex gap-4 w-full justify-center items-center px-2 flex-shrink-0">
                        @foreach($chunk as $partner)
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="flex-shrink-0 hover:opacity-80 transition-opacity duration-300">
                                <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 w-28 object-contain">
                            </a>
                        @else
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 w-28 object-contain flex-shrink-0">
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
                
                <!-- Tablet Carousel (4 logos per slide) -->
                <div id="partnerLogoCarouselTablet" class="hidden sm:flex lg:hidden transition-transform duration-500 ease-in-out">
                    @foreach($partnersLogos->chunk(4) as $chunk)
                    <div class="flex gap-4 w-full justify-center items-center px-4 flex-shrink-0">
                        @foreach($chunk as $partner)
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="flex-shrink-0 hover:opacity-80 transition-opacity duration-300">
                                <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-12 object-contain">
                            </a>
                        @else
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-12 object-contain flex-shrink-0">
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
                
                <!-- Desktop Carousel (7 logos per slide) -->
                <div id="partnerLogoCarouselDesktop" class="hidden lg:flex transition-transform duration-500 ease-in-out">
                    @foreach($partnersLogos->chunk(7) as $chunk)
                    <div class="flex gap-8 w-full justify-center items-center px-8 flex-shrink-0">
                        @foreach($chunk as $partner)
                        @if($partner->website_url)
                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="flex-shrink-0 hover:opacity-80 transition-opacity duration-300">
                                <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 object-contain">
                            </a>
                        @else
                            <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 object-contain flex-shrink-0">
                        @endif
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Mobile Indicators -->
            <div class="flex justify-center gap-2 mt-6 sm:hidden">
                @foreach($partnersLogos->chunk(2) as $index => $chunk)
                <button class="partner-logo-indicator w-3 h-3 {{ $index === 0 ? 'bg-yellow-accent' : 'bg-blue-sda bg-opacity-60' }} rounded-full transition-all duration-300" data-slide="{{ $index }}" data-carousel="mobile"></button>
                @endforeach
            </div>
            
            <!-- Tablet Indicators -->
            <div class="hidden sm:flex lg:hidden justify-center gap-2 mt-6">
                @foreach($partnersLogos->chunk(4) as $index => $chunk)
                <button class="partner-logo-indicator w-3 h-3 {{ $index === 0 ? 'bg-yellow-accent' : 'bg-blue-sda bg-opacity-60' }} rounded-full transition-all duration-300" data-slide="{{ $index }}" data-carousel="tablet"></button>
                @endforeach
            </div>
            
            <!-- Desktop Indicators -->
            <div class="hidden lg:flex justify-center gap-2 mt-6">
                @foreach($partnersLogos->chunk(7) as $index => $chunk)
                <button class="partner-logo-indicator w-3 h-3 {{ $index === 0 ? 'bg-yellow-accent' : 'bg-blue-sda bg-opacity-60' }} rounded-full transition-all duration-300" data-slide="{{ $index }}" data-carousel="desktop"></button>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada logo partner tersedia</p>
            </div>
        @endif
    </div>
</section>