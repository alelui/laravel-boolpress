@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Modifica Post N. {{$post->id}}</h2>
                    <p>Titolo: {{$post->title}}</p>
                </div>
                <div class="card-body">
                    <form action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="image-box col-5 mb-3">
                            @if ($post->image)
                                <img class="w-100" src="{{asset("storage/$post->image")}}" alt="{{$post->title}}">
                            @endif
                        </div>
                        <div class="form-group">
                          <label for="title">Titolo</label>
                          <input type="text" class="form-control" @error('title') is-invalid @enderror id="title" name="title" placeholder="Inserire titolo" value="{{old('title') ? old('title') : $post->title}}">
                            @error('title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Contenuto</label>
                            <textarea class="form-control" @error('content') is-invalid @enderror id="content" name="content" placeholder="Inserire contenuto" rows="3">{{old('content') ? old('content') : $post->content}}</textarea>
                            @error('content')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="category">Categoria</label>
                            <select class="custom-select mb-3" @error('category_id') is-invalid @enderror  name="category_id" id="category">
                                <option value="">Seleziona Una Categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{old("category_id", $post->category_id) == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <h4>Tags</h4>
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline" @error('tags') is-invalid @enderror>
                                    @if (old("tags"))
                                    <input class="form-check-input" type="checkbox" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                                    @else
                                    <input class="form-check-input" type="checkbox" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{$post->tags->contains($tag) ? 'checked' : ''}}>
                                    @endif
                                    <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                                </div>
                            @endforeach
                            @error('tags')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <div>
                                <p class="mb-2" ><label for="image">Aggiungi un'immagine</label></p>
                                <input type="file" id="image" name="image">
                              </div>
                        </div>
                        <div class="form-group form-check">
                            @php
                                $published = old('published') ? old('published') : $post->published;
                            @endphp
                          <input type="checkbox" class="form-check-input" @error('published') is-invalid @enderror id="published" name="published" {{$published ? 'checked' : ''}}>
                            @error('published')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          <label class="form-check-label" for="published">Pubblicato</label>
                        </div>
                        <button type="Aggiungi" class="btn btn-success">Salva</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection