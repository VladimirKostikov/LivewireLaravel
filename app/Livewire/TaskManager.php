<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $tasks;
    public $newTask = '';

    public function mount()
    {
        $this->tasks = Task::all();
    }

    public function addTask()
    {
        $this->validate([
            'newTask' => 'required|string|max:255',
        ]);

        Task::create(['name' => $this->newTask]);

        $this->newTask = '';
        $this->tasks = Task::all();
    }

    public function toggleTask($taskId)
    {
        $task = Task::find($taskId);
        $task->completed = !$task->completed;
        $task->save();

        $this->tasks = Task::all();
    }

    public function deleteTask($taskId)
    {
        Task::find($taskId)->delete();
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }
}
