@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{route('posts.create')}}"><button type="button" class="btn mb-3 btn-success">Aggiungi</button></a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Categoria</th>
            <th scope="col">Stato</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->slug}}</td>
                <td>
                @if ($post->published)
                    <span class="badge badge-success">1</span>
                @else
                    <span class="badge badge-warning">0</span>
                @endif
                </td>
                <td>
                  @if ($post->category)
                    <span class="badge badge-info">{{$post->category->name}}</span>
                  @else
                    <span>Nessuna</span>
                  @endif
                </td>
                <td><a href="{{route("posts.show", $post->id)}}"><button type="button" class="btn btn-primary">Visualizza</button></a></td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection