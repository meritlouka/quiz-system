@extends('layouts.quiz_layout')

@section('content')
    @include('admin.admin_tab')
    @include('settings.settings_tab')
<h1>All the questions</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
 <p><label><input type="checkbox" id="checkAll"/> Check all</label>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>ID</td>
			<td>question</td>
			<td>question_type_id</td>
			<td>category_id</td>
			<td>points</td>
		</tr>
	</thead>
	<tbody>
    <form  action="{{ url('deletequestions') }}">

    <button type="submit">DElete All Checked!</button>		
	@foreach($questions as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->question }}</td>
			<td>{{ $value->question_type_id }}</td>
			<td>{{ $value->category_id }}</td>
            <td>{{ $value->points }}</td>
			<!-- we will also add show, edit, and delete buttons -->
			<td>

				<!-- delete the question (uses the destroy method DESTROY /questions/{id} -->
				<!-- we will add this later since its a little more complicated than the first two buttons -->
				 
				<input type="checkbox" name="checkbox[]"  value="{{$value->id}}" /> 


				
				<!-- edit this question (uses the edit method found at GET /questions/{id}/edit -->
				<a class="btn btn-small btn-info" href="{{ URL::to('questions/' . $value->id . '/edit') }}">Edit this question</a>

			</td>
		</tr>
	@endforeach
	</tbody>
	</form>
</table>

<script type="text/javascript">
  $("#checkAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
</script>
@endsection
