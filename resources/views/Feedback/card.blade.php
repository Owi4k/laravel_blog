<div class="col-md-10">
	<div class="card" >
		<div class="card-header fb">
			<h3>Feedbacks:</h3>
			@foreach($feedbacks as $feedback)
			<p>{{ substr($feedback->created_at, 0, 10) }} <b>{{$feedback->author}}:</b>  {{$feedback->content}}</p>
			<hr>
			@endforeach
		</div>				
		<div class="card-body">
			<form method="POST"	class="send_feedback">
				<div class="form-group row">
					<label for="author" class="col-form-label text-md-right">Author<sup>*</sup></label>

					<div class="col-md-4">
						<input id="author" type="text" class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" required>

						@if ($errors->has('author'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('author') }}</strong>
						</span>
						@endif
					</div>

					<label for="content" class="col-form-label text-md-right">Content<sup>*</sup></label>

					<div class="col-md-4">
						<input id="content" type="text" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" name="content" required>

						@if ($errors->has('content'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('content') }}</strong>
						</span>
						@endif
					</div>

					<div class="col-md-2">
						<button type="submit" class="btn btn-primary button__form">
							Send
						</button>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>
