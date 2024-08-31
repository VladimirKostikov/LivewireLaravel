<div class="chat-container">
    <div class="messages" style="height: 300px; overflow-y: scroll;">
        @foreach($messages as $message)
            <div class="message">
                <strong>{{ $message->user_name }}:</strong> {{ $message->message }}
            </div>
        @endforeach
    </div>

    <div class="input-area mt-4">
        <input type="text" wire:model="userName" placeholder="Your name" class="form-input mt-1 block w-full">
        <textarea wire:model="newMessage" placeholder="Type a message..." class="form-input mt-1 block w-full mt-2"></textarea>
        <button wire:click="sendMessage" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Send</button>
    </div>
</div>
