<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Illuminate\Support\Facades\Log;

class TodoList extends Component
{
    public $todos;
    public $newTask = '';
    public $dueDate;

    protected $rules = [
        'newTask' => 'required|string|max:255',
        'dueDate' => 'nullable|date|after_or_equal:today',
    ];

    public function mount()
    {
        $this->todos = Todo::orderBy('due_date')->get();
    }

    public function addTask()
    {
        $this->validate();

        Todo::create([
            'task' => $this->newTask,
            'due_date' => $this->dueDate,
        ]);

        $this->newTask = '';
        $this->dueDate = null;
        $this->todos = Todo::orderBy('due_date')->get();
        
        // Emit event to refresh the list
        $this->emit('todoListUpdated');

        // Emit a browser event for notification
        $this->dispatchBrowserEvent('task-added', ['task' => $this->newTask]);
    }

    public function toggleTask($taskId)
    {
        $task = Todo::find($taskId);
        $task->completed = !$task->completed;
        $task->save();

        $this->todos = Todo::orderBy('due_date')->get();
        
        // Emit event to refresh the list
        $this->emit('todoListUpdated');

        // Emit a browser event for notification
        if ($task->completed) {
            $this->dispatchBrowserEvent('task-completed', ['task' => $task->task]);
        }
    }

    public function deleteTask($taskId)
    {
        Todo::find($taskId)->delete();
        $this->todos = Todo::orderBy('due_date')->get();

        // Emit event to refresh the list
        $this->emit('todoListUpdated');
    }

    public function getListeners()
    {
        return [
            'todoListUpdated' => '$refresh',
        ];
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
