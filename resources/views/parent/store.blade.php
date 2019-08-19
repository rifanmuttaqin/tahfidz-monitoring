@extends('master')

@section('title', '')

@section('content')
	
	<form method="post" action="{{ route('store-parent') }}">

		@csrf

		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" value="" name="username">
			@if ($errors->has('username'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('username') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" value="" name="email">
			@if ($errors->has('username'))
			    <div class="email"><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" value="" name="full_name">
			@if ($errors->has('full_name'))
			    <div class="email"><p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<textarea class="form-control" placeholder="" rows="3" name="address">
			</textarea>
			@if ($errors->has('address'))
			    <div class="address"><p style="color: red"><span>&#42;</span> {{ $errors->first('address') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Orangtua Dari</label>
            <select class="js-example-basic-single form-control" id="siswa_data" name="siswa_data[]" style="width: 100%" multiple="multiple"></select>
            @if ($errors->has('teacher_id'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('teacher_id') }}</p></div>
			@endif
        </div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Password</label>
			<input type="password" class="form-control" value="" name="password">
			@if ($errors->has('password'))
			    <div class="password"><p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p></div>
			@endif
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Re Password</label>
			<input type="password" class="form-control" value="" name="password_confirmation">
			@if ($errors->has('password'))
			    <div class="password"><p style="color: red"><span>&#42;</span> {{ $errors->first('password') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
	    $('#siswa_data').select2({
	    	allowClear: true,
			placeholder: 'Masukkan Nama Siswa',
			ajax: {
				url: base_url + '/parent/get-siswa',
				dataType: 'json',
				data: function(params) {
				    return {
				      search: params.term
				    }
				},
				processResults: function (data, page) {
				    return {
				        results: data
				    };
				}
			}
	    });
	});
</script>
@endpush