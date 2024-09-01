<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class PostManagement extends Component
{
    public $posts;
    public $title;
    public $content;
    public $editMode = false;
    public $postId;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    public function mount()
    {
        $this->posts = Post::all();
    }

    public function createPost()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->resetFields();
        $this->posts = Post::all();
        $this->emit('postCreated');
    }

    public function editPost($postId)
    {
        $post = Post::find($postId);
        $this->postId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->editMode = true;
    }

    public function updatePost()
    {
        $this->validate();

        $post = Post::find($this->postId);
        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->resetFields();
        $this->posts = Post::all();
        $this->editMode = false;
        $this->emit('postUpdated');
    }

    public function deletePost($postId)
    {
        Post::find($postId)->delete();
        $this->posts = Post::all();
        $this->emit('postDeleted');
    }

    private function resetFields()
    {
        $this->title = '';
        $this->content = '';
        $this->postId = null;
        $this->editMode = false;
    }

    public function render()
    {
        return view('livewire.post-management');
    }
}
