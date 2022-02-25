<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    protected $validationRules = [
        "title" => 'required|string|max:100',
        "content" => 'required|string',
        "published" => 'sometimes|accepted',
        // catwegory_id: può essere nullo|verificase esite id nella tabella categories
        "category_id" => 'nullable|exists:categories,id',
        //image: valore del max espresso in kB, il mimme specivica i formati ammesssi
        "image" => 'nullable|mimes:jpeg,bmp,png|max:2048',
        //possono essrene nulla ma se esitono sono nella tabella tags colonna id e controlla se sono validi
        "tags" => 'nullable|exists:tags,id'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();
        return view('admin.posts.index', compact("posts", "tags"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //dd($request->all());
        //validazione dati
        //richiamo l'array delle valiazioni
        $request->validate($this->validationRules); 

        //creazione post
        $data = $request->all();
        $newPost = new Post();
        $newPost->title = $data["title"];
        $newPost->content = $data["content"];
        $newPost->published = isset( $data["published"]);
        $newPost->category_id = $data["category_id"];

        $slug = Str::of($newPost->title)->slug('-');
        $count = 1;
        //prende il primo posto il cui slug è uguale a $slug
        //se è presente genera uun nuovo slug aggiungento -$count
        while(Post::where('slug', $slug)->first()){
            $slug = Str::of($newPost->title)->slug('-')."-{$count}";
            $count++;
        }
        $newPost->slug = $slug;

        //slavataggio immagine se presnte
        if(isset($data["image"])){
            $path_Img = Storage::put("uploads", $data["image"]);
            $newPost->image = $path_Img;
        }
        //salvataggio modifiche DB
        $newPost->save();
        if (isset($data["tags"])) {
            $newPost->tags()->sync($data["tags"]);
        }

        //redirect al post creato
        return redirect()->route('posts.show', $newPost->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact("post","categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //validazione dati
        //richiamo l'array delle valiazioni
        $request->validate($this->validationRules); 
        // dd($request->all());

        //aggiornamento post all'interno del DB
        $data = $request->all();

        //se il titolo cambia aggiorno lo slug
        if( $post->titolo != $data["title"] ) {
            $post->title = $data["title"];

            $slug = Str::of($post->title)->slug('-');

            //se lo slug generato e diverso da quello salvato nel DB
            if( $slug != $post->slug ){
                $count = 1;
                while(Post::where('slug', $slug)->first()){
                    $slug = Str::of($post->title)->slug('-')."-{$count}";
                    $count++;
                }
                $post->slug = $slug;
            }
        }
        $post->content = $data["content"];
        $post->published = isset( $data["published"]);
        $post->category_id = $data["category_id"];
        
        //slavataggio immagine se presnte e cancello vecchia img
        if(isset($data["image"])){
            //cancella vaechia img
            Storage::delete($post->image);
            //salva nuova img
            $path_Img = Storage::put("uploads", $data["image"]);
            $post->image = $path_Img;
        }

        $post->save();

        if (isset($data["tags"])) {
            $post->tags()->sync($data["tags"]);
        }
        return view('admin.posts.show', compact("post"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
