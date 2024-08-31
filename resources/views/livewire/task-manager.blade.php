<div>
    <div class="mb-4">
        <input type="text" wire:model="newTask" placeholder="Add a new task" class="form-input mt-1 block w-full">
        <button wire:click="addTask" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Task</button>
    </div>

    <ul>
        @foreach($tasks as $task)
            <li class="flex items-center mb-2">
                <input type="checkbox" wire:click="toggleTask({{ $task->id }})" {{ $task->completed ? 'checked' : '' }} class="mr-2">
                <span class="{{ $task->completed ? 'line-through' : '' }}">{{ $task->name }}</span>
                <button wire:click="deleteTask({{ $task->id }})" class="ml-auto px-2 py-1 bg-red-500 text-white rounded">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
