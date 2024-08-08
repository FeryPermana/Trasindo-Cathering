@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h4>{{ $action }} Menu</h4>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('merchant.menu.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ $url }}" method="POST" enctype="multipart/form-menu">
            @csrf
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', @$menu->name) }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', @$menu->price) }}">
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="photo" class="form-label">Photo coming Soon</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description', @$menu->description) }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary text-end">Submit</button>
        </form>
    </div>
</div>
@endsection
