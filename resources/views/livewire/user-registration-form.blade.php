<div>
    <form wire:submit.prevent="register">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="form-input mt-1 block w-full">
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" id="email" wire:model="email" class="form-input mt-1 block w-full">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" id="password" wire:model="password" class="form-input mt-1 block w-full">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-input mt-1 block w-full">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Register</button>
    </form>

    <script>
        window.addEventListener('user-registered', event => {
            alert(`User Registered: ${event.detail.name}`);
        });
    </script>
</div>
