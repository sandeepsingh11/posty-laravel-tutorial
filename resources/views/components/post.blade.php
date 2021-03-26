@props(['post' => $post])



<div class="mb-4">
    <a href="{{ route('user.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

    <p class="mb-1">{{ $post->body }}</p>

    @auth
        @can('delete', $post)
            <form action="{{ route('posts.delete', $post) }}" method="post" class="mr-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">Delete</button>
            </form>
        @endcan
    @endauth

    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                {{-- pass the id into the route --}}
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-2">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth

        <span>{{ $post->likes->count() }}  {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>

</div>