<x-layout>

    <h1 class="title">Welcome {{ auth()->user()->name }}</h1>
    {{-- create post form --}}
    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new post</h2>

        {{-- session messages --}}
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500"/>
        @endif

        {{-- create post form --}}
        <form action="{{ route('posts.store') }}"method="post" enctype="multipart/form-data">
            @csrf
            {{-- post title --}}
            <div class="mb-4">
                <label for="title">Post Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="input">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            {{-- post body --}}
            <div class="mb-4">
                <label for="body">Post Content</label>
                <textarea name="body" rows="7" class="input @error('body') ring-red-500
                    @enderror">{{ old('body') }}</textarea>

                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{--post img--}}
            <div class="mb-4">
                <label for="image">Cover photo</label>
                <input type="file"name="image"id="image">

                @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
            </div>

            {{-- submit button --}}
            <button class="btn">Create</button>
        </form>

    </div>

    <div class="grid grid-cols-2 gap-6">

        @foreach ($posts as $post)
            <x-postCard :post="$post">

                {{--update form--}}
              <a href="{{route('posts.edit',$post)}}"class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

                {{-- delete post --}}
                <form action="{{ route('posts.destroy', $post) }}"method="post">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                </form>
            </x-postCard>
        @endforeach
    </div>
    <div>
        {{ $posts->links() }}
    </div>

</x-layout>
