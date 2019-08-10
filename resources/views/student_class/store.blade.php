@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{ route('store-student-class') }}">

		@csrf

		<div class="form-group">
			<label>Angkatan</label>
            <select class="form-control" id="angkatan" name="angkatan" style="width: 100%">
            	@foreach ($years as $year)
                	<option value="{{ $year }}"> {{ $year }} </option>
            	@endforeach
            </select>
            @if ($errors->has('angkatan'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('teacher_id') }}</p></div>
			@endif
        </div>

		<div class="form-group">
			<label>Guru</label>
            <select class="js-example-basic-single form-control" id="guru" name="teacher_id" style="width: 100%"></select>
            @if ($errors->has('teacher_id'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('teacher_id') }}</p></div>
			@endif
        </div>

		<div class="form-group">
			<label>Kelas</label>
			<input type="text" class="form-control" value="" name="class_name">
			@if ($errors->has('class_name'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('class_name') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Catatan</label>
			<input type="text" class="form-control" value="" name="note">
			@if ($errors->has('note'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('note') }}</p></div>
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
	    $('#guru').select2({
	    	allowClear: true,
			placeholder: 'Masukkan Nama Guru',
			ajax: {
				url: base_url + '/student-class/get-user-teacher',
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