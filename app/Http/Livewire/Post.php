<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Post extends Component
{
    use WithFileUploads;

    public int $postId = 0;

    public string $title = "";
    public string $subtitle = "";
    public string $description = "";
    public string $autor = "";
    public string $date = "";
    public string $type = "";
    public string $content = "";
    public string $link = "";
    public string $references = "";

    public bool $view = false;

    public $posts;

    public $photo;

    public function render()
    {
        $this->posts = \App\Models\Post::where('user_id', auth()->user()->id)->get();
        return view('livewire.post', ['posts' => $this->posts]);
    }

    public function submit()
    {
        $post = new \App\Models\Post();
        $post->title = $this->title;
        $post->subtitle = $this->subtitle;
        $post->description = $this->description;
        $post->autor = $this->autor;
        $post->type = $this->type;
        $post->user_id = auth()->user()->id;
        $post->date = $this->date;
        $post->link = $this->link;
        $post->references = $this->references;
        $post->content = $this->content;
        $post->image = asset('images/post.jpg');
        $post->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->cleanData();
        session()->flash('message', 'Publicación Creada Exitosamente.');

    }

    public function cleanData(){
        $this->reset(['title','subtitle','description','autor','type','date','link','references','content']);
    }

    public function savePhoto($id)
    {
        $response = $this->photo->store('posts','public_posts');
        $actual_post = \App\Models\Post::find($id);
        $actual_post->image = $response;
        $actual_post->save();
        $this->view = false;
        $this->render();
    }

    public function changeView()
    {
        if ($this->view == false) {
            $this->view = true;
        } else {
            $this->view = false;
        }
    }

    public function deletePost($id){
        \App\Models\Post::destroy($id);
        $this->render();
    }

    public function openCreateModal(){
        $this->cleanData();
        $this->dispatchBrowserEvent('openModal');
    }

    public function showPost($id){

        $post = \App\Models\Post::find($id);

        $this->postId = $post->id;
        $this->title = $post->title;
        $this->subtitle = $post->subtitle;
        $this->description = $post->description;
        $this->autor = $post->autor;
        $this->type = $post->type;
        $this->date = $post->date;
        $this->link = $post->link;
        $this->references = $post->references;
        $this->content = $post->content;

        $this->dispatchBrowserEvent('openUpdateModal');
    }

    public function updatePost(){

        $post = \App\Models\Post::find($this->postId);

        Log::debug($post);

        $post->title = $this->title;
        $post->subtitle = $this->subtitle;
        $post->description = $this->description;
        $post->autor = $this->autor;
        $post->type = $this->type;
        $post->date = $this->date;
        $post->link = $this->link;
        $post->references = $this->references;
        $post->content = $this->content;
        $post->save();
        $this->dispatchBrowserEvent('closeUpdateModal');
        session()->flash('message', 'Publicación Actualizada Exitosamente.');

    }

}
