<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class LiveSearch extends Component
{
    public $search = '';
    public $posts = [];

    public function updatedSearch()
    {
        $this->posts = Post::where('title', 'like', '%' . $this->search . '%')
                            ->orWhere('content', 'like', '%' . $this->search . '%')
                            ->get();
    }

    public function render()
    {
        return view('livewire.live-search');
    }
}
