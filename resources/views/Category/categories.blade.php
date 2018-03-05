@extends('layouts.app')

@section('content')
<div class="container">
	<a class="btn btn-primary" href="{{ route('createCategory') }}">Create</a>
    <div class="row justify-content-center">
        @foreach($categories as $category)
		<div class="card" style="width: 18rem; margin: 1em;">
			<div class="card-body">
				<h5 class="card-title">{{$category->name}}</h5>
		    	<p class="card-text">{{$category->description}}</p>
		    	<a href="{{ route('showCategory', $category->id) }}" class="card-link">Watch</a>
			</div>
		</div>
        @endforeach
    </div>
</div>
@endsection
