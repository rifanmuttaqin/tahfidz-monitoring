@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{route('store-iqro')}}">

		@csrf

		<div class="form-group">
			<label>Nomor Jilid</label>
			<input type="text" class="form-control" value="" name="jilid_number">
			@if ($errors->has('jilid_number'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('jilid_number') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Total Halaman</label>
			<input type="text" class="form-control" value="" name="total_page">
			@if ($errors->has('total_page'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('total_page') }}</p></div>
			@endif
		</div>
	
		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
@endsection

@push('scripts')

<script type="text/javascript">
</script>

@endpush