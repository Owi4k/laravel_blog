@extends('layouts.app')

@section('content')
<div class="container">
        <a class="btn btn-primary" href="{{ route('editCategory', $category->id) }}">Edit</a>
        <form action="{{ route('deleteCategory', $category->id)}}" method="POST">
        	{{ csrf_field() }}
        	<button class="btn btn-danger" type="submit">Delete</button>
        </form>
    <div class="row justify-content-center">
		<div class="col-md-10">
			<div class="card">
				<div class="card-header">
					<h3>{{$category->name}}</h3>
				</div>
				<div class="card-body">
					<h4>Content:</h4>
			    	<h5>{{$category->description}}</h5>
			    	<div class="col justify-content-center">	
						<div class="card" >
							<div class="card-header">Posts </div>
							<div class="card-body">
							@foreach($category->posts as $post)
							<a href="{{ route('showPost', $post->id) }}">{{ $post->name }} | </a>
							@endforeach
							</div>
						</div>
					</div>		
			  	</div>
			</div>
		</div>
		@include('Feedback.card')
    <input type="hidden" id="category_id" value="{{ $category->id }}">
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/categoryFB.js') }}"></script>
@endsection
