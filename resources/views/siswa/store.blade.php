@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="">

		@csrf

		<div class="form-group">
			<label>Nama Siswa</label>
			<input type="text" class="form-control" value="" name="siswa_name">
			@if ($errors->has('siswa_name'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('siswa_name') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Jenis Hafalan</label>
			<input type="text" class="form-control" value="" name="memorization_type">
			@if ($errors->has('memorization_type'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('memorization_type') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Kelas </label>
			<input type="text" class="form-control" value="" name="class_id">
			@if ($errors->has('class_id'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('class_id') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Orangtua </label>
			<input type="text" class="form-control" value="" name="parent_id">
			@if ($errors->has('parent_id'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('parent_id') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
@endsection