<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Countries</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

	<div class="container col-md-6 mt-4">
		<!-- Content here -->

		@if(Session::get('message'))
		<div class="alert alert-success" role="alert">
			{{Session::get('message')}}
		</div>
		@endif
		
		<form action="{{route('submitData')}}" method="post">
			@csrf
			<label>Country</label>

			<select id="country" name="country_id" class="form-select mt-2" aria-label="Default select example">
				<option selected>Select</option>
				@foreach($countries as $country)
				<option value="{{$country->id}}">{{$country->name}}</option>
				@endforeach

			</select>

			<label class="mt-4">Cities</label>
			<select id="city" name="city_id" class="form-select mt-2" aria-label="Default select example">

				
				

			</select>

			<label class="mt-4">Areas</label>
			<select id="area" name="area_id" class="form-select mt-2" aria-label="Default select example">
			</select>

		<!-- <label class="mt-4">Cities</label>

		<select class="form-select mt-2" aria-label="Default select example">
			<option selected>Select</option>
			<option value="1">One</option>
			<option value="2">Two</option>
			<option value="3">Three</option>
		</select>

		<label class="mt-4">Areas</label>

		<select class="form-select mt-2" aria-label="Default select example">
			<option selected>Select</option>
			<option value="1">One</option>
			<option value="2">Two</option>
			<option value="3">Three</option>
		</select> -->

		<button type="submit" class="mt-2 btn btn-success">Submit</button>

	</form>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#country').on('change',function(e) {
			var country_id = e.target.value;
			$.ajax({
				url:"{{ route('ajax-get-cities') }}",
				type:"POST",
				data: {
					_token: "{{ csrf_token() }}",
					country_id: country_id
				},
				success:function (data) {
					$('#city').empty();
					$('#area').empty();
					$('#city').append('<option selected>Select</option>');
					$.each(data.cities,function(index,city){
						$('#city').append('<option value="'+city.id+'">'+city.name+'</option>');
					})
				}
			})
		});
	});
</script>
<script>
	$(document).ready(function () {
		$('#city').on('change',function(e) {
			var city_id = e.target.value;
			$.ajax({
				url:"{{ route('ajax-get-areas') }}",
				type:"POST",
				data: {
					_token: "{{ csrf_token() }}",
					city_id: city_id
				},
				success:function (data) {
					$('#area').empty();
					$.each(data.areas,function(index,area){
						$('#area').append('<option value="'+area.id+'">'+area.name+'</option>');
					})
				}
			})
		});
	});
</script>
</body>
</html>