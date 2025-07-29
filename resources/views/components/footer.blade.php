<!-- Footer -->
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid lg:grid-cols-2 gap-16">
            <!-- Footer Left -->
            <div class="space-y-8">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/Logo-footer.png') }}" alt="Logo PU" class="w-[425px] h-[74px] object-contain">
                </div>
                
                @if(isset($footerInfo))
                <div class="space-y-2">
                    <p class="text-base text-blue-sda leading-relaxed">
                        {{ $footerInfo['address'] ?? 'Jl. Abdurachman Saleh No. 230 Palu Provinsi Sulawesi Tengah, Indonesia' }}
                    </p>
                    <p class="text-base text-blue-sda">
                        {{ $footerInfo['phone'] ?? 'Telp. (0451) 482147' }}      {{ $footerInfo['fax'] ?? 'Fax. (0451) 482101' }}
                    </p>
                    @if(isset($footerInfo['email']) && $footerInfo['email'])
                    <p class="text-base text-blue-sda">
                        Email: {{ $footerInfo['email'] }}
                    </p>
                    @endif
                </div>
                @else
                <p class="text-base text-blue-sda leading-relaxed">
                    Jl. Abdurachman Saleh No. 230 Palu Provinsi Sulawesi Tengah, Indonesia<br>
                    Telp. (0451) 482147      Fax. (0451) 482101
                </p>
                @endif
                
                <div class="flex gap-6">
                    <a href="{{ isset($footerInfo) && $footerInfo['social_facebook'] && $footerInfo['social_facebook'] !== '#' ? $footerInfo['social_facebook'] : '#' }}" target="_blank" class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center hover:bg-blue-700 transition-colors">
                        <img src="{{ asset('assets/icons/facebook.svg') }}" alt="Facebook" class="w-4 h-4">
                    </a>
                    <a href="{{ isset($footerInfo) && $footerInfo['social_instagram'] && $footerInfo['social_instagram'] !== '#' ? $footerInfo['social_instagram'] : '#' }}" target="_blank" class="w-8 h-8 bg-gradient-to-r from-yellow-400 via-red-500 to-purple-600 rounded flex items-center justify-center hover:opacity-90 transition-opacity">
                        <img src="{{ asset('assets/icons/instagram.svg') }}" alt="Instagram" class="w-4 h-4">
                    </a>
                    <a href="{{ isset($footerInfo) && $footerInfo['social_x'] && $footerInfo['social_x'] !== '#' ? $footerInfo['social_x'] : '#' }}" target="_blank" class="w-8 h-8 bg-black rounded flex items-center justify-center hover:bg-gray-800 transition-colors">
                        <img src="{{ asset('assets/icons/twitter.svg') }}" alt="X (Twitter)" class="w-4 h-4">
                    </a>
                    <a href="{{ isset($footerInfo) && $footerInfo['social_youtube'] && $footerInfo['social_youtube'] !== '#' ? $footerInfo['social_youtube'] : '#' }}" target="_blank" class="w-8 h-8 bg-red-600 rounded flex items-center justify-center hover:bg-red-700 transition-colors">
                        <img src="{{ asset('assets/icons/youtube.svg') }}" alt="YouTube" class="w-4 h-4">
                    </a>
                </div>
            </div>
            
            <!-- Footer Right -->
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Services -->
                <div class="space-y-6">
                    <h4 class="text-base font-medium text-blue-sda">Layanan</h4>
                    <div class="space-y-2">
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">e-SISDA</a>
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">SIHKA</a>
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">Sistem Informasi Geografis</a>
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">Kaledo</a>
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">E-Rekomtek</a>
                    </div>
                </div>
                
                <!-- Additional Services -->
                <div class="space-y-6">
                    <div class="space-y-2">
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">Whistleblowing PU</a>
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">SP4N - Lapor!</a>
                        <a href="#" class="block text-sm text-blue-sda hover:text-blue-600 transition-colors">EARR</a>
                    </div>
                </div>
                
                <!-- Visitor Data -->
                <div class="space-y-4">
                    <h4 class="text-base font-medium text-blue-sda">Data Pengunjung</h4>
                    
                    
                    @if(isset($webSettings['visitor_counter_code']) && $webSettings['visitor_counter_code'])
                        <div class="visitor-counter bg-white p-4 border border-gray-200 rounded">
                            <div class="text-xs text-gray-500 mb-2">SuperCounters Loading...</div>
                            {!! str_replace('//', 'https://', $webSettings['visitor_counter_code']) !!}
                        </div>
                    @else
                        <img src="{{ asset('assets/images/data-pengujung.jpg') }}" alt="Visitor Data" class="w-48 h-44">
                    @endif
                    
                    <img src="{{ asset('assets/images/logo-vkan.png') }}" alt="KAN Logo" class="w-36 h-16">
                </div>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="bg-blue-sda px-4 py-3">
        <div class="max-w-7xl mx-auto">
            <p class="text-white text-xs font-normal text-center">
                @if(isset($footerInfo['copyright']) && $footerInfo['copyright'])
                    {{ $footerInfo['copyright'] }}
                @else
                    Copyright © {{ date('Y') }}. Balai Wilayah Sungai Sulawesi III Palu. All Rights Reserved.
                @endif
            </p>
        </div>
    </div>
</footer>