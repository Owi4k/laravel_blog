@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create post</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('storePost') }} " enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">Name<sup>*</sup></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-4 col-form-label text-md-right">Content<sup>*</sup></label>

                            <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required></textarea>

                                @if ($errors->has('content'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-sm-4 col-form-label text-md-right">Image</label>

                            <div class="col-md-6">
                                <input id="image" type="file" accept="image/*" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" >

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="categories" class="col-sm-4 col-form-label text-md-right">Categories</label>

                            @if(count($categories))
                            <div class="col-md-6">
                                <select id="categories" name="categories[]" class="form-control" multiple>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            @else
                            <h4>There are no categories.</h4>
                            @endif
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
