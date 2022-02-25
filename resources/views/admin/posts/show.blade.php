@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$post->title}}</h2>
                </div>
                <div class="card-body">
                    <div class="image-box col-5 mb-3">
                        @if ($post->image)
                            <img class="w-100" src="{{asset("storage/$post->image")}}" alt="{{$post->title}}">
                        @endif
                    </div>
                    <p>{{$post->content}}</p>
                    @if ($post->published)
                        <span class="badge badge-success">Pubblicato</span>
                    @else
                        <span class="badge badge-warning">Bozza</span>
                    @endif
                    <div class="category">
                        @if ($post->category) {{-- categoy rappresenta la classe nel model (public function), cosi facendo creiamo una join --}}
                        <span class="badge badge-info">{{$post->category->name}}</span> 
                        @endif
                    </div>
                    <div class="category">
                        @if (count($post->tags) > 0) {{--  --}}
                            @foreach ($post->tags as $tag)
                            <span class="badge badge-secondary">{{$tag->name}}</span> 
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{route('posts.edit', $post->id)}}"><button type="button" class="btn mt-4 btn-dark">Modifica</button></a>
            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn mt-3 btn-danger">dev/null</button>
            </form>
        </div>
    </div>
</div>
@endsection