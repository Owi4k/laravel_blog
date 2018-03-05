@extends('layouts.app')

@section('content')
<div class="container">
		<a class="btn btn-primary" href="{{ route('editPost', $post->id) }}">Edit</a>
        <form action="{{ route('deletePost', $post->id)}}" method="POST">
        	{{ csrf_field() }}
        	<button class="btn btn-danger" type="submit">Delete</button>
        </form>
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>{{$post->name}}</h3>
				</div>
				<div class="card-body">
					@isset($post->image)
					<img src="{{$post->image}}" class="img">
					@endisset
					<span>Content:</span>
			    	<span>{{$post->content}}</span>
			    	<div class="col justify-content-center">	
						<div class="card" >
							<div class="card-header">Categories </div>
							<div class="card-body">
							@foreach($post->categories as $category)
							<a href="{{ route('showCategory', $category->id) }}">{{ $category->name }} | </a>
							@endforeach
							<input type="hidden" id="post_id" value="{{ $post->id }}">
							</div>
						</div>
					</div>		
			  	</div>
			</div>
		</div>
	</div>

	<div class="row justify-content-center">
		@include('Feedback.card')
	</div>
</div>
<script type="text/javascript" src="{{ asset('js/postFB.js') }}"></script>
@endsection
