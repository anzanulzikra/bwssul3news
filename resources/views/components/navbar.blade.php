<!-- Header Navigation -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo Section -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo BWS Sulawesi III Palu" class="w-[250px] h-[42px] lg:w-[307px] lg:h-[52px] object-contain">
            </div>
            
            <!-- Navigation Menu -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('home.index') }}" class="text-blue-sda hover:text-blue-600 transition-colors">Beranda</a>
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
                <div class="relative group">
                    <button class="flex items-center gap-1 text-blue-sda hover:text-blue-600 transition-colors">
                        Berita
                        <img src="{{ asset('assets/icons/chevron-down.svg') }}" alt="Dropdown" class="w-4 h-4">
                    </button>
                </div>
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
            
            <!-- Search Input -->
            <div class="hidden md:flex items-center">
                <div class="w-[250px] h-[40px] px-2 py-2 bg-white rounded-lg border-2 border-yellow-500 flex items-center gap-2">
                    <img src="{{ asset('assets/icons/search.svg') }}" alt="Search" class="w-5 h-5">
                    <input type="text" placeholder="Cari Berita" class="w-full text-blue-sda text-sm font-normal outline-none pr-2">
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button class="md:hidden text-blue-sda" id="mobileMenuBtn">
                <img src="{{ asset('assets/icons/menu.svg') }}" alt="Menu" class="w-6 h-6">
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div id="mobileMenu" class="fixed inset-0 z-50 bg-white flex flex-col p-8 space-y-8 transition-transform duration-300 transform -translate-x-full md:hidden">
    <button id="closeMobileMenu" class="self-end mb-8">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-blue-sda">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <nav class="flex flex-col gap-6">
        <a href="{{ route('home.index') }}" class="text-blue-sda text-lg font-medium">Beranda</a>
        <a href="#" class="text-blue-sda text-lg font-medium">Profil</a>
        <a href="#" class="text-blue-sda text-lg font-medium">Layanan</a>
        <a href="#" class="text-blue-sda text-lg font-medium">Berita</a>
        <a href="#" class="text-blue-sda text-lg font-medium">Informasi Publik</a>
        <a href="#" class="text-blue-sda text-lg font-medium">Publikasi</a>
    </nav>
</div>