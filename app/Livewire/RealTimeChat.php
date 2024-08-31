<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Message;

class RealTimeChat extends Component
{
    public $messages;
    public $newMessage = '';
    public $userName = 'Guest';

    protected $rules = [
        'newMessage' => 'required|string|max:255',
        'userName' => 'required|string|max:50',
    ];

    public function mount()
    {
        $this->messages = Message::latest()->get();
    }

    public function sendMessage()
    {
        $this->validate();

        Message::create([
            'user_name' => $this->userName,
            'message' => $this->newMessage,
        ]);

        $this->newMessage = '';
        $this->messages = Message::latest()->get();
        $this->emit('messageSent');
    }

    public function getListeners()
    {
        return [
            'messageSent' => '$refresh',
        ];
    }

    public function render()
    {
        return view('livewire.real-time-chat');
    }
}
