@extends('master')

@section('title', '')

@section('content')
	
	<form method="post" action="{{ route('store') }}">

		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" value="" name="username">
		</div>

		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" value="" name="email">
		</div>

		<div class="form-group">
			<label>Nama</label>
			<input type="text" class="form-control" value="" name="full_name">
		</div>

		<div class="form-group">
			<label for="sel1">Tipe Akun</label>
			<select class="form-control" id="sel1">
				<option value="" >User</option>
				<option value="" >Guru</option>
				<option value="" >Orangtua</option>
			</select>
		</div>

		<div class="form-group">
			<label>Alamat</label>
			<textarea class="form-control" placeholder="" rows="3" name="address">
			</textarea>
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Password</label>
			<input type="text" class="form-control" value="" name="password">
		</div>

		<div class="form-group col-md-6" style="padding-left: 0px">
			<label>Re Password</label>
			<input type="text" class="form-control" value="" name="password_confirmation">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-info"> TAMBAH </button>
		</div>

	</form>
	
@endsection