@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{ route('store-role') }}">

		@csrf

		<div class="form-group">
			<label>Nama Role</label>
			<input type="text" class="form-control" value="" name="name">
			@if ($errors->has('name'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('name') }}</p></div>
			@endif
		</div>

		<fieldset>
		<legend>Daftar Permission</legend>

			<div class="checkbox-inline">
				    <input id='check_all' name="check_all" type="checkbox">
				    <label> <strong> Pilih Semua </strong></label>
			</div>

			<hr>
				<div class="col-md-12">			
				@foreach ($data_permission as $permission)
				    <div class="checkbox-inline">
					   <input id='{{ $permission->id }}' name="permission[]" type="checkbox" value="{{ $permission->id }}">
					   <label for="permission_{{ $permission->id }}"> {{ $permission->name }} </label>
					</div>
					<br>
				@endforeach
				</div>
		</fieldset>
		
		<div class="form-group" style="padding-top: 20px">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>
	</form>
	
@endsection

@push('scripts')

<script type="text/javascript">
	
$( document ).ready(function() {
	$("#check_all").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});
});
	
		
</script>

@endpush