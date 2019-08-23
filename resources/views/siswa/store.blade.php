@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{ route('store-siswa') }}">

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
			<select class="form-control" name="memorization_type">
				<option value="{{ Siswa::TYPE_IQRO }}" >Iqro</option>
				<option value="{{ Siswa::TYPE_QURAN }}" >Alquran</option>
			</select>
			@if ($errors->has('memorization_type'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('memorization_type') }}</p></div>
			@endif
		</div>
		<div class="form-group">
			<label>Kelas </label>
			<select class="js-example-basic-single form-control" name="class_id" id="class_id" style="width: 100%">
	          <option></option>
	        </select>
			@if ($errors->has('class_id'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('class_id') }}</p></div>
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
		$('#class_id').select2({
			allowClear: true,
			ajax: {
			  url: base_url + '/siswa/get-class',
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