<!-- Carousel JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hero Carousel
        const carousel = document.getElementById('heroCarousel');
        const indicators = document.querySelectorAll('.carousel-indicator');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if (carousel && indicators.length > 0) {
            let currentSlide = 0;
            const totalSlides = indicators.length;
            
            // Slider titles array
            const sliderTitles = [
                @if($sliderWebs ?? false)
                    @foreach($sliderWebs as $index => $slider)
                        "{{ addslashes($slider->title) }}"@if(!$loop->last),@endif
                    @endforeach
                @endif
            ];
            
            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
                
                // Update indicators
                indicators.forEach((indicator, index) => {
                    if (index === currentSlide) {
                        indicator.classList.remove('bg-blue-sda', 'bg-opacity-60');
                        indicator.classList.add('bg-yellow-accent');
                    } else {
                        indicator.classList.remove('bg-yellow-accent');
                        indicator.classList.add('bg-blue-sda', 'bg-opacity-60');
                    }
                });
                
                // Update hero subtitle text
                const heroSubtitle = document.getElementById('heroSubtitle');
                if (heroSubtitle && sliderTitles.length > 0) {
                    heroSubtitle.textContent = sliderTitles[currentSlide] || 'Siap Membangun Negeri Untuk Rakyat';
                }
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                updateCarousel();
            }
            
            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                updateCarousel();
            }
            
            // Event listeners
            if (nextBtn) nextBtn.addEventListener('click', nextSlide);
            if (prevBtn) prevBtn.addEventListener('click', prevSlide);
            
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentSlide = index;
                    updateCarousel();
                });
            });
            
            // Auto-play carousel
            setInterval(nextSlide, 5000);
        }

        // Mobile Partner Carousel
        const mobilePartnerCarousel = document.getElementById('mobilePartnerCarousel');
        const mobilePartnerIndicators = document.querySelectorAll('.mobile-partner-indicator');
        const mobilePartnerPrevBtn = document.getElementById('mobilePartnerPrevBtn');
        const mobilePartnerNextBtn = document.getElementById('mobilePartnerNextBtn');
        
        if (mobilePartnerCarousel && mobilePartnerIndicators.length > 0) {
            let currentMobilePartnerSlide = 0;
            const totalMobilePartnerSlides = mobilePartnerIndicators.length;
            
            function updateMobilePartnerCarousel() {
                mobilePartnerCarousel.style.transform = `translateX(-${currentMobilePartnerSlide * 100}%)`;
                
                // Update indicators
                mobilePartnerIndicators.forEach((indicator, index) => {
                    if (index === currentMobilePartnerSlide) {
                        indicator.classList.remove('bg-opacity-50');
                        indicator.classList.add('bg-yellow-accent');
                    } else {
                        indicator.classList.add('bg-opacity-50');
                        indicator.classList.remove('bg-yellow-accent');
                    }
                });
            }
            
            function nextMobilePartnerSlide() {
                currentMobilePartnerSlide = (currentMobilePartnerSlide + 1) % totalMobilePartnerSlides;
                updateMobilePartnerCarousel();
            }
            
            function prevMobilePartnerSlide() {
                currentMobilePartnerSlide = (currentMobilePartnerSlide - 1 + totalMobilePartnerSlides) % totalMobilePartnerSlides;
                updateMobilePartnerCarousel();
            }
            
            // Event listeners for mobile partner carousel
            if (mobilePartnerNextBtn) {
                mobilePartnerNextBtn.addEventListener('click', nextMobilePartnerSlide);
            }
            if (mobilePartnerPrevBtn) {
                mobilePartnerPrevBtn.addEventListener('click', prevMobilePartnerSlide);
            }
            
            mobilePartnerIndicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentMobilePartnerSlide = index;
                    updateMobilePartnerCarousel();
                });
            });
        }

        // Partner Logo Carousel - Responsive
        const partnerPrevBtn = document.getElementById('partnerPrevBtn');
        const partnerNextBtn = document.getElementById('partnerNextBtn');
        
        // Mobile carousel
        const mobileCarousel = document.getElementById('partnerLogoCarousel');
        const mobileIndicators = document.querySelectorAll('.partner-logo-indicator[data-carousel="mobile"]');
        
        // Tablet carousel
        const tabletCarousel = document.getElementById('partnerLogoCarouselTablet');
        const tabletIndicators = document.querySelectorAll('.partner-logo-indicator[data-carousel="tablet"]');
        
        // Desktop carousel
        const desktopCarousel = document.getElementById('partnerLogoCarouselDesktop');
        const desktopIndicators = document.querySelectorAll('.partner-logo-indicator[data-carousel="desktop"]');
        
        let currentSlides = { mobile: 0, tablet: 0, desktop: 0 };
        
        function getCurrentCarousel() {
            if (window.innerWidth < 640) return 'mobile';
            if (window.innerWidth < 1024) return 'tablet';
            return 'desktop';
        }
        
        function getCarouselElements(type) {
            switch(type) {
                case 'mobile':
                    return { carousel: mobileCarousel, indicators: mobileIndicators };
                case 'tablet':
                    return { carousel: tabletCarousel, indicators: tabletIndicators };
                case 'desktop':
                    return { carousel: desktopCarousel, indicators: desktopIndicators };
                default:
                    return { carousel: null, indicators: [] };
            }
        }
        
        function updatePartnerCarousel(type) {
            const { carousel, indicators } = getCarouselElements(type);
            if (!carousel || indicators.length === 0) return;
            
            const currentSlide = currentSlides[type];
            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
            
            // Update indicators
            indicators.forEach((indicator, index) => {
                if (index === currentSlide) {
                    indicator.classList.remove('bg-blue-sda', 'bg-opacity-60');
                    indicator.classList.add('bg-yellow-accent');
                } else {
                    indicator.classList.remove('bg-yellow-accent');
                    indicator.classList.add('bg-blue-sda', 'bg-opacity-60');
                }
            });
        }
        
        function nextPartnerSlide() {
            const currentType = getCurrentCarousel();
            const { indicators } = getCarouselElements(currentType);
            if (indicators.length > 0) {
                currentSlides[currentType] = (currentSlides[currentType] + 1) % indicators.length;
                updatePartnerCarousel(currentType);
            }
        }
        
        function prevPartnerSlide() {
            const currentType = getCurrentCarousel();
            const { indicators } = getCarouselElements(currentType);
            if (indicators.length > 0) {
                currentSlides[currentType] = (currentSlides[currentType] - 1 + indicators.length) % indicators.length;
                updatePartnerCarousel(currentType);
            }
        }
        
        // Event listeners for navigation buttons
        if (partnerNextBtn) partnerNextBtn.addEventListener('click', nextPartnerSlide);
        if (partnerPrevBtn) partnerPrevBtn.addEventListener('click', prevPartnerSlide);
        
        // Event listeners for all indicators
        [...mobileIndicators, ...tabletIndicators, ...desktopIndicators].forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                const carouselType = indicator.dataset.carousel;
                const slideIndex = parseInt(indicator.dataset.slide);
                currentSlides[carouselType] = slideIndex;
                updatePartnerCarousel(carouselType);
            });
        });
        
        // Auto-play partner carousel
        setInterval(nextPartnerSlide, 4000);
        
        // Update carousel on window resize
        window.addEventListener('resize', () => {
            const currentType = getCurrentCarousel();
            updatePartnerCarousel(currentType);
        });


        // Modal functionality
        window.currentInstagramUrl = '';

        window.openModal = function(title, imageUrl, linkUrl) {
            const modal = document.getElementById('infografisModal');
            const modalContent = document.getElementById('infografisModalContent');
            const modalTitle = document.getElementById('modalTitle');
            const modalImage = document.getElementById('modalImage');
            
            modalTitle.textContent = title;
            modalImage.src = imageUrl;
            modalImage.alt = title;
            window.currentInstagramUrl = linkUrl;
            
            // Show modal with fade animation
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Trigger animation
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            });
        };

        window.closeModal = function() {
            const modal = document.getElementById('infografisModal');
            const modalContent = document.getElementById('infografisModalContent');
            
            // Start fade out animation
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            
            // Hide modal after animation completes
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300); // Match transition duration
        };

        window.openInstagram = function() {
            if (window.currentInstagramUrl) {
                window.open(window.currentInstagramUrl, '_blank');
            }
        };

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('infografisModal');
            if (e.target === modal) {
                closeModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    });
</script>
<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 500,
    easing: 'ease-out-cubic',
    once: true,
    offset: 60,
  });
</script>

<!-- Smooth Scrolling JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Back to top functionality
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = `
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
        </svg>
    `;
    backToTopBtn.className = 'fixed bottom-6 right-6 w-12 h-12 bg-blue-sda text-white rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 pointer-events-none z-40 flex items-center justify-center';
    backToTopBtn.setAttribute('aria-label', 'Back to top');
    document.body.appendChild(backToTopBtn);

    // Show/hide back to top button
    let isScrolling = false;
    window.addEventListener('scroll', () => {
        if (!isScrolling) {
            window.requestAnimationFrame(() => {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
                    backToTopBtn.classList.add('opacity-100');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
                    backToTopBtn.classList.remove('opacity-100');
                }
                isScrolling = false;
            });
        }
        isScrolling = true;
    });

    // Back to top click handler
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Smooth scroll for page navigation
    window.smoothScrollTo = function(elementId, offset = 0) {
        const element = document.getElementById(elementId);
        if (element) {
            const targetPosition = element.offsetTop - offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    };
});
</script>