@extends('master')

@section('title', '')

@section('alert')

@if(Session::has('alert_success'))
  @component('components.alert')
        @slot('class')
            success
        @endslot
        @slot('title')
            Terimakasih
        @endslot
        @slot('message')
            {{ session('alert_success') }}
        @endslot
  @endcomponent
@elseif(Session::has('alert_error'))
  @component('components.alert')
        @slot('class')
            error
        @endslot
        @slot('title')
            Cek Kembali
        @endslot
        @slot('message')
            {{ session('alert_error') }}
        @endslot
  @endcomponent 
@endif

@endsection

@section('content')

	<form method="post" action="{{route('store-notification')}}">

		@csrf

		<div class="form-group">
			<label>Tipe Notifikasi</label>
			<select class="form-control" name="notification_type" id="notification_type">
			<option value="{{ Notification::NOTIFICATION_TYPE_PARENT }}" > Untuk Orangtua</option>
			<option value="{{ Notification::NOTIFICATION_TYPE_TEACHER }}" > Untuk Guru / Admin </option>
			</select>
		</div>

		<div class="form-group">
			<label>Judul Notifikasi</label>
			<input type="text" class="form-control" value="" name="notification_title">
			@if ($errors->has('notification_title'))
			    <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('notification_title') }}</p></div>
			@endif
		</div>

		<div class="form-group">
			<label>Pesan Notifikasi</label>
			<textarea class="form-control" placeholder="" rows="3" id="notification_message" name="notification_message"></textarea>
		</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-info"> KIRIM </button>
		</div>

	</form>

	<hr> 

	<div class="table-responsive">
		<table class="table table-bordered data-table display nowrap" style="width:100%">
		<thead>
		    <tr>
		        <th>Title Notifikasi</th>
		        <th>Isi Notifikasi</th>
		        <th>Tanggal Notifikasi</th>
		        <th>Jenis Notifikasi</th>
		    </tr>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
	
@endsection

@push('scripts')

<script type="text/javascript">

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      "aaSorting": [[ 2, "desc" ]],
      ajax: "{{ route('notification') }}",
      columns: [
          {data: 'notification_title', name: 'notification_title'},
          {data: 'notification_message', name: 'notification_message'},
          {data: 'date', name: 'date'},
          {data: 'notification_type', name: 'notification_type'}
      ]
  });
});

</script>

@endpush