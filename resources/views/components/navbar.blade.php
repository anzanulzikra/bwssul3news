<!-- Header Navigation -->
<header class="bg-white shadow-sm border-b border-gray-200 w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-between items-center h-20 min-w-0">
            <!-- Logo Section - Always Left -->
            <div class="flex items-center gap-3 flex-shrink min-w-0">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo BWS Sulawesi III Palu" class="w-[220px] h-[37px] sm:w-[260px] sm:h-[44px] lg:w-[307px] lg:h-[52px] object-contain flex-shrink-0 max-w-full">
            </div>
            
            <!-- Navigation Menu (Desktop only) -->
            <nav class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-blue-sda hover:text-blue-600 transition-colors">Beranda</a>
                <div class="relative group">
                    <button class="flex items-center gap-1 text-blue-sda hover:text-blue-600 transition-colors">
                        Profil
                        <img src="{{ asset('assets/icons/chevron-down.svg') }}" alt="Dropdown" class="w-4 h-4">
                    </button>
                </div>
                <div class="relative group">
                    <button class="flex items-center gap-1 text-blue-sda hover:text-blue-600 transition-colors">
                        Layanan
                        <img src="{{ asset('assets/icons/chevron-down.svg') }}" alt="Dropdown" class="w-4 h-4">
                    </button>
                </div>
                <a href="{{ route('articles.listing') }}" class="text-blue-sda hover:text-blue-600 transition-colors">Berita</a>
                <div class="relative group">
                    <button class="flex items-center gap-1 text-blue-sda hover:text-blue-600 transition-colors">
                        Informasi Publik
                        <img src="{{ asset('assets/icons/chevron-down.svg') }}" alt="Dropdown" class="w-4 h-4">
                    </button>
                </div>
                <div class="relative group">
                    <button class="flex items-center gap-1 text-blue-sda hover:text-blue-600 transition-colors">
                        Publikasi
                        <img src="{{ asset('assets/icons/chevron-down.svg') }}" alt="Dropdown" class="w-4 h-4">
                    </button>
                </div>
            </nav>
            
            <!-- Tablet Layout: Search + Hamburger -->
            <div class="flex md:flex lg:hidden items-center gap-4">
                <!-- Tablet Search Input -->
                <div class="hidden md:flex items-center flex-shrink min-w-0">
                    <form action="{{ route('articles.listing') }}" method="GET" class="w-[180px] h-[36px] px-2 py-2 bg-white rounded-lg border-2 border-yellow-500 flex items-center gap-2">
                        <img src="{{ asset('assets/icons/search.svg') }}" alt="Search" class="w-4 h-4 flex-shrink-0">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari Berita" 
                               class="flex-1 text-blue-sda text-sm font-normal outline-none min-w-0"
                               onkeypress="handleSearchKeypress(event)">
                        <button type="submit" class="hidden">Search</button>
                    </form>
                </div>
                
                <!-- Mobile/Tablet Menu Button -->
                <button class="lg:hidden text-blue-sda flex-shrink-0 p-1 relative z-10" id="mobileMenuBtn">
                    <img src="{{ asset('assets/icons/menu.svg') }}" alt="Menu" class="w-6 h-6">
                </button>
            </div>
            
            <!-- Desktop Search Input -->
            <div class="hidden lg:flex items-center flex-shrink min-w-0">
                <form action="{{ route('articles.listing') }}" method="GET" class="w-[200px] lg:w-[250px] h-[40px] px-2 py-2 bg-white rounded-lg border-2 border-yellow-500 flex items-center gap-2">
                    <img src="{{ asset('assets/icons/search.svg') }}" alt="Search" class="w-5 h-5 flex-shrink-0">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari Berita" 
                           class="flex-1 text-blue-sda text-sm font-normal outline-none min-w-0"
                           onkeypress="handleSearchKeypress(event)">
                    <button type="submit" class="hidden">Search</button>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Mobile/Tablet Navigation Drawer -->
<div id="mobileMenu" class="fixed inset-0 z-[9999] bg-white flex flex-col transition-transform duration-300 transform -translate-x-full lg:hidden overflow-y-auto overflow-x-hidden w-full h-full max-w-full">
    <div class="flex flex-col p-4 space-y-4 w-full h-full" style="max-width: 100vw; box-sizing: border-box;">
    <!-- Header with Logo and Close Button -->
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo BWS Sulawesi III Palu" class="w-[220px] h-[37px] sm:w-[260px] sm:h-[44px] object-contain">
        </div>
        <button id="closeMobileMenu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-blue-sda">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <nav class="flex flex-col gap-4 w-full overflow-hidden">
        <a href="{{ route('home') }}" class="text-blue-sda text-base sm:text-lg font-medium truncate">Beranda</a>
        <a href="#" class="text-blue-sda text-base sm:text-lg font-medium truncate">Profil</a>
        <a href="#" class="text-blue-sda text-base sm:text-lg font-medium truncate">Layanan</a>
        
        <a href="{{ route('articles.listing') }}" class="text-blue-sda text-base sm:text-lg font-medium truncate">Berita</a>
        
        <a href="#" class="text-blue-sda text-base sm:text-lg font-medium truncate">Informasi Publik</a>
        <a href="#" class="text-blue-sda text-base sm:text-lg font-medium truncate">Publikasi</a>
        
        <!-- Mobile Search (only on mobile, not tablet) -->
        <div class="md:hidden mt-4 pt-4 border-t border-gray-200" style="width: calc(100% - 2rem); margin-left: 0; margin-right: 0;">
            <form action="{{ route('articles.listing') }}" method="GET" class="h-[40px] px-2 py-2 bg-white rounded-lg border-2 border-yellow-500 flex items-center gap-2" style="width: 100%; max-width: 100%; box-sizing: border-box;">
                <img src="{{ asset('assets/icons/search.svg') }}" alt="Search" class="w-4 h-4 flex-shrink-0">
                <input type="text" 
                       name="search" 
                       placeholder="Cari Berita" 
                       class="flex-1 text-blue-sda text-sm font-normal outline-none" style="min-width: 0; width: 0;">
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>
    </nav>
    </div>
</div>

<script>
function handleSearchKeypress(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        const form = event.target.closest('form');
        const searchValue = event.target.value.trim();
        
        if (searchValue) {
            form.submit();
        }
    }
}

// Mobile Menu Toggle - Standalone script
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeMobileMenu = document.getElementById('closeMobileMenu');
    
    if (mobileMenuBtn && mobileMenu && closeMobileMenu) {
        // Open mobile menu
        mobileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            mobileMenu.classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden';
        });
        
        // Close mobile menu
        closeMobileMenu.addEventListener('click', function(e) {
            e.preventDefault();
            mobileMenu.classList.add('-translate-x-full');
            document.body.style.overflow = 'auto';
        });
        
        // Close menu when clicking outside
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                mobileMenu.classList.add('-translate-x-full');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Close menu with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('-translate-x-full')) {
                mobileMenu.classList.add('-translate-x-full');
                document.body.style.overflow = 'auto';
            }
        });
    }

    // Auto-focus search when clicking on search icon
    const searchIcons = document.querySelectorAll('img[alt="Search"]');
    searchIcons.forEach(function(icon) {
        icon.addEventListener('click', function() {
            const searchInput = this.nextElementSibling;
            if (searchInput && searchInput.tagName === 'INPUT') {
                searchInput.focus();
            }
        });
    });
});
</script>