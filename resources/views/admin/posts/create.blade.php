@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>Nuovo Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-5">
                            <h4>Titolo</h4>
                          <input type="text" class="form-control" @error('title') is-invalid @enderror id="title" name="title" placeholder="Inserire titolo" value="{{old("title")}}">
                            @error('title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <h4>Contenuto</h4>
                            <textarea class="form-control" @error('content') is-invalid @enderror id="content" name="content" placeholder="Inserire contenuto" rows="3">{{old("content")}}</textarea>
                            @error('content')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          </div>
                        <div class="form-group mb-5">
                            <h4>Categoria</h4>
                            <select class="custom-select mb-3" @error('category_id') is-invalid @enderror name="category_id" id="category">
                                <option value="">Seleziona Una Categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{old("category_id") == $category->id ? "selected" : ""}}>{{$category->name}}</option>
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
                                    <input class="form-check-input" type="checkbox" id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
                                </div>
                            @endforeach
                            @error('tags')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <div>
                                <p class="mb-2" ><label for="image"><strong>Aggiungi un'immagine</strong></label></p>
                                <input type="file" id="image" name="image">
                              </div>
                        </div>
                        <div class="form-group mb-5 form-check">
                          <input type="checkbox" class="form-check-input" @error('published') is-invalid @enderror id="published" name="published">
                            @error('published')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                          <label class="form-check-label" for="published">Pubblicato</label>
                        </div>
                        <button type="Aggiungi" class="btn btn-success">Aggiungi</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection