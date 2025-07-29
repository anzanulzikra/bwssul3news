@extends('layouts.detail', ['title' => $article->title])

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-8">
        <div class="flex items-center gap-2 flex-wrap">
            <div class="flex items-center gap-1">
                <img src="{{ asset('assets/icons/home.svg') }}" alt="Home" class="w-4 h-4">
                <a href="{{ route('home') }}" class="text-yellow-accent text-sm font-normal hover:underline">Beranda</a>
            </div>
            <span class="text-blue-sda text-sm font-normal">/</span>
            <a href="{{ route('articles.listing') }}" class="text-yellow-accent text-sm font-normal hover:underline">Berita</a>
            <span class="text-blue-sda text-sm font-normal">/</span>
            <span class="text-blue-sda text-sm font-normal">{{ Str::limit($article->title, 50) }}</span>
        </div>
        
        <!-- Back Button -->
        <a href="{{ route('articles.listing') }}" class="mt-4 h-10 px-4 rounded-lg inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 transition-colors">
            <img src="{{ asset('assets/icons/arrow-left.svg') }}" alt="Back" class="w-5 h-5">
            <span class="text-blue-sda text-sm font-normal">Kembali ke Berita</span>
        </a>
    </div>

    <!-- Article Content -->
    <article class="max-w-4xl mx-auto">
        <!-- Article Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-medium text-blue-sda leading-9 mb-4">
                {{ $article->title }}
            </h1>
            <div class="flex items-center gap-4 text-lg font-normal text-gray-700 mb-2">
                <span>{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                @if($article->category)
                    <span class="text-yellow-accent">•</span>
                    <span class="text-yellow-accent">{{ $article->category->name }}</span>
                @endif
            </div>
        </header>

        <!-- Featured Image -->
        <div class="mb-8">
            @if($article->featured_image)
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-auto rounded-lg">
            @else
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                    <span class="text-gray-400">No Image Available</span>
                </div>
            @endif
        </div>

        <!-- Article Body -->
        <div class="prose prose-lg max-w-none mb-8">
            @if($article->excerpt)
                <div class="bg-yellow-50 border-l-4 border-yellow-accent p-4 mb-6">
                    <p class="text-lg font-medium text-blue-sda italic">{{ $article->excerpt }}</p>
                </div>
            @endif
            
            <div class="text-lg leading-7 text-gray-700">
                {!! $article->content !!}
            </div>
            
            @if($article->tags && $article->tags->count() > 0)
                <div class="mt-8">
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <span class="px-4 py-2 bg-blue-100 text-blue-sda text-sm rounded-full font-medium">#{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mt-8">
                    <div class="flex flex-wrap gap-2">
                        <span class="px-4 py-2 bg-blue-100 text-blue-sda text-sm rounded-full font-medium">#SigapMembangunNegeriUntukRakyat</span>
                        <span class="px-4 py-2 bg-blue-100 text-blue-sda text-sm rounded-full font-medium">#MengelolaAirUntukNegeri</span>
                    </div>
                </div>
            @endif
        </div>

        @if($article->images && $article->images->count() > 0)
            <!-- Divider -->
            <hr class="border-2 border-zinc-500 my-8">

            <!-- Photo Gallery -->
            <section class="mb-8">
                <h2 class="text-2xl font-medium text-blue-sda mb-6">Foto Kegiatan</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($article->images as $index => $image)
                        <div class="group cursor-pointer" onclick="openPhotoGallery({{ $index }})">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption ?? $article->title }}" class="w-full h-48 object-cover rounded-lg transition-transform duration-200 group-hover:scale-105 group-hover:shadow-lg">
                            @if($image->caption)
                                <p class="text-sm text-gray-600 mt-2">{{ $image->caption }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Divider -->
        <hr class="border-2 border-zinc-500 my-8">

        <!-- Share Section -->
        <section class="mb-8">
            <h2 class="text-2xl font-medium text-blue-sda mb-6">Bagikan Postingan Ini</h2>
            <div class="flex gap-6">
                <button onclick="shareToFacebook()" class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                    <img src="{{ asset('assets/icons/facebook.svg') }}" alt="Facebook" class="w-6 h-6">
                </button>
                <button onclick="shareToTwitter()" class="w-12 h-12 bg-black rounded-lg flex items-center justify-center hover:bg-gray-800 transition-colors">
                    <img src="{{ asset('assets/icons/twitter.svg') }}" alt="Twitter" class="w-6 h-6">
                </button>
                <button onclick="copyToClipboard()" class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center hover:bg-green-600 transition-colors">
                    <img src="{{ asset('assets/icons/link.svg') }}" alt="Copy Link" class="w-6 h-6">
                </button>
            </div>
        </section>

        @if($relatedArticles && $relatedArticles->count() > 0)
            <!-- Related Articles -->
            <section class="mb-8">
                <h2 class="text-2xl font-medium text-blue-sda mb-6">Berita Terkait</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('article.detail', $related->slug) }}" class="block group">
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 transition-transform duration-200 group-hover:-translate-y-1 group-hover:shadow-lg">
                                <div class="space-y-4">
                                    @if($related->featured_image)
                                        <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}" class="w-full h-32 object-cover rounded-lg">
                                    @else
                                        <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-sm">No Image</span>
                                        </div>
                                    @endif
                                    <div class="space-y-2">
                                        <p class="text-xs font-bold text-blue-sda opacity-60">{{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}</p>
                                        <h4 class="text-sm font-semibold text-blue-sda leading-tight group-hover:text-blue-sda">
                                            {{ Str::limit($related->title, 80) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </article>

    @push('scripts')
    <script>
        // Photo Gallery Data
        @if($article->images && $article->images->count() > 0)
        const photoGallery = [
            @foreach($article->images as $image)
            {
                src: '{{ asset('storage/' . $image->image_path) }}',
                title: '{{ addslashes($article->title) }}',
                caption: '{{ addslashes($image->caption ?? '') }}'
            }@if(!$loop->last),@endif
            @endforeach
        ];

        function openPhotoGallery(startIndex = 0) {
            openImageGallery(photoGallery, startIndex);
        }
        @endif

        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ addslashes($article->title) }}');
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${title}`, '_blank', 'width=600,height=400');
        }
        
        function shareToTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent('{{ addslashes($article->title) }}');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank', 'width=600,height=400');
        }
        
        function copyToClipboard() {
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Link berhasil disalin!');
            }, function(err) {
                console.error('Error copying link: ', err);
            });
        }
    </script>
    @endpush
@endsection