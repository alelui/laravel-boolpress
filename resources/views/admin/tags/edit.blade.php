@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Modifica Tag: {{$tag->name}}</h2>
                    <p>ID: {{$tag->id}}</p>
                </div>
                <div class="card-body">
                    <form action="{{route('tags.update', $tag->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                          <label for="name"><strong>Nuovo Nome</strong></label>
                          <input type="text" class="form-control" @error('name') is-invalid @enderror id="name" name="name" placeholder="Inserire tag" value="{{old('name') ? old('name') : $tag->name}}">
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        <button type="Aggiungi" class="btn btn-success mt-3">Salva</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection