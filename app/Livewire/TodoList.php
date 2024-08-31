<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Carbon\Carbon;

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
    }

    public function toggleTask($taskId)
    {
        $task = Todo::find($taskId);
        $task->completed = !$task->completed;
        $task->save();

        $this->todos = Todo::orderBy('due_date')->get();
    }

    public function deleteTask($taskId)
    {
        Todo::find($taskId)->delete();
        $this->todos = Todo::orderBy('due_date')->get();
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
