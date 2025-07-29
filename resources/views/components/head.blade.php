<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $title ?? 'BWS Sulawesi III Palu - Mengelola Air untuk Negeri' }}</title>
<meta name="description" content="{{ $description ?? 'Website resmi Balai Wilayah Sungai Sulawesi III Palu. Informasi, berita, layanan, dan publikasi seputar pengelolaan sumber daya air di Sulawesi Tengah.' }}">
<link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Boy CDN -->
<script src="https://unpkg.com/@boy-org/boy@latest/dist/boy.min.js"></script>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Tailwind Config -->
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    'inter': ['Inter', 'sans-serif']
                },
                colors: {
                    'blue-sda': '#243365',
                    'yellow-accent': '#FFB703',
                    'zinc': {
                        100: '#f4f4f5',
                        500: '#71717a'
                    }
                }
            }
        }
    }
</script>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<!-- Smooth Scrolling CSS -->
<style>
    html {
        scroll-behavior: smooth;
    }
    
    /* Custom scrollbar styling */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #243365;
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #1a2550;
    }
    
    /* Line clamp utility for consistent text truncation */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.5;
        height: 3em; /* 2 lines * 1.5 line-height */
    }
</style>