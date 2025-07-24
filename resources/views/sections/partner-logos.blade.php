<!-- Partner Logos Carousel Section -->
<section class="py-16 bg-gray-100" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($partnersLogos->count() > 0)
            <!-- Partner Logos Carousel -->
            <div class="relative overflow-hidden py-8">
                <div id="partnerLogoCarousel" class="flex transition-transform duration-500 ease-in-out">
                    @foreach($partnersLogos->chunk(7) as $chunk)
                    <div class="flex gap-8 w-full justify-center items-center px-8 flex-shrink-0">
                        @foreach($chunk as $partner)
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" class="h-16 object-contain flex-shrink-0">
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Carousel Indicators -->
            <div class="flex justify-center gap-2 mt-6">
                @foreach($partnersLogos->chunk(7) as $index => $chunk)
                <button class="partner-logo-indicator w-3 h-3 {{ $index === 0 ? 'bg-yellow-accent' : 'bg-blue-sda bg-opacity-60' }} rounded-full transition-all duration-300" data-slide="{{ $index }}"></button>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada logo partner tersedia</p>
            </div>
        @endif
    </div>
</section>