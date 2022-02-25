@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2>New Category</h2>
                </div>
                <div class="card-body">
                    <form action="{{route('categories.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="name">Nome</label>
                          <input type="text" class="form-control" @error('name') is-invalid @enderror id="name" name="name" placeholder="Inserire titolo">
                            @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="Aggiungi" class="btn btn-success">Aggiungi</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection