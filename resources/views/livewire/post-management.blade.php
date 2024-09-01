<div>
    <form wire:submit.prevent="{{ $editMode ? 'updatePost' : 'createPost' }}">
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" wire:model="title" class="form-input mt-1 block w-full">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-700">Content</label>
            <textarea id="content" wire:model="content" class="form-input mt-1 block w-full"></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
            {{ $editMode ? 'Update Post' : 'Create Post' }}
        </button>
    </form>

    <h2 class="mt-6 text-lg">Posts</h2>
    <ul>
        @foreach($posts as $post)
            <li class="flex justify-between items-center mb-2">
                <div>
                    <h3 class="text-xl">{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                </div>
                <div>
                    <button wire:click="editPost({{ $post->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                    <button wire:click="deletePost({{ $post->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                </div>
            </li>
        @endforeach
    </ul>

    <script>
        window.addEventListener('postCreated', event => {
            alert('Post Created Successfully!');
        });

        window.addEventListener('postUpdated', event => {
            alert('Post Updated Successfully!');
        });

        window.addEventListener('postDeleted', event => {
            alert('Post Deleted Successfully!');
        });
    </script>
</div>
