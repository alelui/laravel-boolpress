@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-3">Categories List's</h1>
    <a href="{{route('categories.create')}}"><button type="button" class="btn mb-3 btn-success">Aggiungi</button></a>

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
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->id}}</th>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td><a href="{{route("categories.show", $category->id)}}"><button type="button" class="btn btn-primary">Visualizza</button></a></td>
              </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection