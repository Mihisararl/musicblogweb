@props(['post', 'full' => false])

<div class="card">
    {{-- cover photo --}}
    <div>
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="">
        @else
            <img src="{{ asset('storage/posts_images/default.png') }}" alt="">
        @endif

    </div>
    {{-- title --}}
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>

    {{-- author and date --}}
    <div class="text-xs font-light mb-4">
        <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $post->user) }}"class="text-blue-500 font-medium">{{ $post->user->name }}</a>
    </div>

    {{-- Body --}}
    @if ($full)
        {{-- Show full body text in single post page --}}
        <div class="text-sm">
            <span>{{ $post->body }}</span>
        </div>
    @else
        {{-- Show limited body text in single post page --}}
        <div class="text-sm">
            <span>{{ Str::words($post->body, 15) }}</span>
            <a href="{{ route('posts.show', $post) }}" class="text-blue-500 ml-2">Read more &rarr;</a>
        </div>
    @endif

    {{-- Placeholder for extra elements used in user dashboard --}}
    <div>
        {{ $slot }}
    </div>
</div>
