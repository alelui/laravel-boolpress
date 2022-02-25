@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-3">Tags List's</h1>
    <a href="{{route('tags.create')}}"><button type="button" class="btn mb-3 btn-success">Aggiungi</button></a>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Slug</th>
            <th scope="col">Azioni</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <th scope="row">{{$tag->id}}</th>
                <td>{{$tag->name}}</td>
                <td>{{$tag->slug}}</td>
                <td><a href="{{route("tags.show", $tag->id)}}"><button type="button" class="btn btn-primary">View</button></a></td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection