{{-- Content Grid Component --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-12 justify-items-center">
    @forelse($items as $item)
        <div class="w-[330px] bg-white shadow-sm border border-yellow-500 p-4 transition-transform duration-200 hover:-translate-y-1 hover:shadow-lg">
            <div class="space-y-4">
                <div class="space-y-2">
                    {{-- Date --}}
                    <p class="text-xs font-bold text-blue-sda opacity-60">
                        @if($contentType === 'article' || $contentType === 'article-eksternal')
                            {{ ($item->published_at ?? $item->created_at)->format('d M Y') }}
                        @else
                            {{ $item->created_at->format('d M Y') }}
                        @endif
                    </p>
                    
                    {{-- Title --}}
                    <h3 class="text-sm font-semibold text-blue-sda leading-tight h-10 overflow-hidden line-clamp-2">
                        @if($contentType === 'article')
                            <a href="{{ route('article.detail', $item->slug) }}" class="hover:text-blue-600 transition-colors" title="{{ $item->title }}">
                                {{ Str::limit($item->title, 70) }}
                            </a>
                        @elseif($contentType === 'mixed')
                            @if(isset($item->article_type) && $item->article_type === 'external')
                                <a href="{{ $item->link ?? '#' }}" target="_blank" class="hover:text-blue-600 transition-colors" title="{{ $item->title }}">
                                    {{ Str::limit($item->title, 70) }}
                                </a>
                            @else
                                <a href="{{ route('article.detail', $item->slug) }}" class="hover:text-blue-600 transition-colors" title="{{ $item->title }}">
                                    {{ Str::limit($item->title, 70) }}
                                </a>
                            @endif
                        @elseif($contentType === 'article-eksternal')
                            <a href="{{ $item->source_url ?? '#' }}" target="_blank" class="hover:text-blue-600 transition-colors" title="{{ $item->title }}">
                                {{ Str::limit($item->title, 70) }}
                            </a>
                        @elseif($contentType === 'gallery')
                            <a href="{{ route('gallery.detail', $item->slug) }}" class="hover:text-blue-600 transition-colors" title="{{ $item->title }}">
                                {{ Str::limit($item->title, 70) }}
                            </a>
                        @elseif($contentType === 'publikasi')
                            <a href="{{ $item->file_url }}" target="_blank" class="hover:text-blue-600 transition-colors" title="{{ $item->title }}">
                                {{ Str::limit($item->title, 70) }}
                            </a>
                        @else
                            <span title="{{ $item->title }}">{{ Str::limit($item->title, 70) }}</span>
                        @endif
                    </h3>
                    
                    {{-- Category and Type Badge --}}
                    <div class="flex flex-wrap gap-1 items-center">
                        @if($contentType === 'mixed' && isset($item->article_type))
                            <span class="text-xs {{ $item->article_type === 'internal' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }} px-2 py-1 rounded-full font-medium">
                                {{ $item->article_type === 'internal' ? 'Internal' : 'External' }}
                            </span>
                        @endif
                        
                        @if(isset($item->category) && $item->category)
                            <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">
                                {{ $item->category->name }}
                            </span>
                        @endif
                    </div>
                </div>
                
                {{-- Image --}}
                @if($contentType === 'article')
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover ">
                    @else
                        <div class="w-full h-48 bg-gray-200  flex items-center justify-center">
                            <span class="text-gray-500 text-sm">No Image</span>
                        </div>
                    @endif
                @elseif($contentType === 'mixed')
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover ">
                    @else
                        <div class="w-full h-48 bg-gray-200  flex items-center justify-center">
                            <span class="text-gray-500 text-sm">No Image</span>
                        </div>
                    @endif
                @elseif($contentType === 'article-eksternal')
                    @if($item->featured_image)
                        <img src="{{ asset('storage/' . $item->featured_image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover ">
                    @else
                        <div class="w-full h-48 bg-gray-200  flex items-center justify-center">
                            <span class="text-gray-500 text-sm">No Image</span>
                        </div>
                    @endif
                @elseif($contentType === 'gallery')
                    @if($item->featured_photo)
                        <img src="{{ asset('storage/' . $item->featured_photo) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover ">
                    @else
                        <div class="w-full h-48 bg-gray-200  flex items-center justify-center">
                            <span class="text-gray-500 text-sm">No Image</span>
                        </div>
                    @endif
                @elseif($contentType === 'publikasi')
                    @if($item->cover_image)
                        <img src="{{ asset('storage/' . $item->cover_image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover ">
                    @else
                        <div class="w-full h-48 bg-blue-100  flex items-center justify-center">
                            <svg class="w-16 h-16 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                @else
                    {{-- Default image handling for other content types --}}
                    @if(isset($item->image) && $item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title }}" 
                             class="w-full h-48 object-cover ">
                    @else
                        <div class="w-full h-48 bg-gray-200  flex items-center justify-center">
                            <span class="text-gray-500 text-sm">No Image</span>
                        </div>
                    @endif
                @endif
                
                {{-- Description/Summary (optional) --}}
                @if(isset($item->summary) && $item->summary)
                    <p class="text-xs text-gray-600 line-clamp-2">
                        {{ Str::limit($item->summary, 100) }}
                    </p>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12">
            <div class="text-gray-500 text-lg mb-4">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-gray-500">Tidak ada konten yang ditemukan</p>
            </div>
        </div>
    @endforelse
</div>