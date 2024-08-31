<div>
    <input type="text" wire:model="search" placeholder="Search posts..." class="form-input mt-1 block w-full">
    
    @if(strlen($search) > 0)
        <ul class="mt-4">
            @forelse($posts as $post)
                <li class="border-b border-gray-200 py-2">
                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    <p class="text-gray-600">{{ Str::limit($post->content, 100) }}</p>
                </li>
            @empty
                <li class="py-2">No results found.</li>
            @endforelse
        </ul>
    @endif
</div>
