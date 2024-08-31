<div>
    <div class="mb-4">
        <input type="text" wire:model="newTask" placeholder="New task" class="form-input mt-1 block w-full">
        <input type="date" wire:model="dueDate" class="form-input mt-2 block w-full">
        <button wire:click="addTask" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Task</button>
    </div>

    <ul>
        @foreach($todos as $todo)
            <li class="flex items-center mb-2">
                <input type="checkbox" wire:click="toggleTask({{ $todo->id }})" {{ $todo->completed ? 'checked' : '' }} class="mr-2">
                <span class="{{ $todo->completed ? 'line-through' : '' }}">{{ $todo->task }} (Due: {{ $todo->due_date ? $todo->due_date->format('M d, Y') : 'No due date' }})</span>
                <button wire:click="deleteTask({{ $todo->id }})" class="ml-auto px-2 py-1 bg-red-500 text-white rounded">Delete</button>
            </li>
        @endforeach
    </ul>
</div>
