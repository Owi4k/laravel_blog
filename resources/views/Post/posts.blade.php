@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('createPost') }}" class="btn btn-primary">Create</a>
    <div class="row justify-content-center">
            @foreach($posts as $post)
            <div class="card" style="width: 18rem; margin: 1em;">
                @isset($post->image)
                <img src="{{$post->image}}" class="card-img-top">
                @endisset
                <div class="card-body">
                    <h5 class="card-title">{{$post->name}}</h5>
                    <p class="card-text">{{$post->content}}</p>
                    <a href="{{ route('showPost', $post->id) }}" class="btn btn-primary">Watch</a>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endsection
