<div>
    <h1>{{ $count }}</h1>
 
    <button wire:click="increment">+</button>
 
    <button wire:click="decrement">-</button>

    <form>
        <label for="title">Title: {{ $title }}</label>
    
        <input type="text" id="title" wire:model="title"> 
    </form>
</div>