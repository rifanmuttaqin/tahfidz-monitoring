@extends('master')

@section('title', '')

@section('content')

	<form method="post" action="{{route('store-alquran')}}">

		@csrf
		
		<div class="form-group">
			<label>Nama Surat</label>
			<input type="text" class="form-control" value="" name="surah_name">
			@if ($errors->has('surah_name'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('surah_name') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Total Ayat</label>
			<input type="text" class="form-control" value="" name="total_ayat">
			@if ($errors->has('total_ayat'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('total_ayat') }}</p></div>
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