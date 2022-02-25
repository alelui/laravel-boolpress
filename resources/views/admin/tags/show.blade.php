@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{$tag->name}}</h2>
                </div>
                    {{--in questo caso $tag->posts, posts fa rifermiento al metodo nel model del Tag--}}
                    @if (count($tag->posts) > 0)
                        <div class="card-body">
                            <h4>Lista {{$tag->name}}</h3>
                            <ul>
                                @foreach ($tag->posts as $post)
                                    <li>{{$post->title}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            </div>
            <a href="{{route('tags.edit', $tag->id)}}"><button type="button" class="btn mt-4 btn-dark">Modifica</button></a>
            <form action="{{route('tags.destroy', $tag->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn mt-3 btn-danger">dev/null</button>
            </form>
        </div>
    </div>
</div>
@endsection