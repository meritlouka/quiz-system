
<h1>All the questions</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Email</td>
			<td>question Level</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
	@foreach($questions as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->name }}</td>
			<td>{{ $value->email }}</td>
			<td>{{ $value->question_level }}</td>

			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the question (uses the destroy method DESTROY /questions/{id} -->
				<!-- we will add this later since its a little more complicated than the first two buttons -->
				{{ Form::open(array('url' => 'questions/' . $value->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this question', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}

				<!-- show the question (uses the show method found at GET /questions/{id} -->
				<a class="btn btn-small btn-success" href="{{ URL::to('questions/' . $value->id) }}">Show this question</a>

				<!-- edit this question (uses the edit method found at GET /questions/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('questions/' . $value->id . '/edit') }}">Edit this question</a>

			</td>
		</tr>
	@endforeach
	</tbody>
</table>

