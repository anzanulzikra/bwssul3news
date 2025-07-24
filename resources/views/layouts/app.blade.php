<!DOCTYPE html>
<html lang="id">
<head>
    @include('components.head', ['title' => $title ?? null])
</head>
<body class="bg-gray-50 font-inter overflow-x-hidden">
    @include('components.navbar')
    
    <main>
        @yield('content')
    </main>
    
    @include('components.footer', ['footerInfo' => $footerInfo ?? null])
    
    @include('components.image-modal')
    @include('components.scripts')
    @stack('scripts')
</body>
</html>