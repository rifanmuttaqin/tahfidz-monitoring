<?php
	use Yajra\Datatables\Datatables;
?>

@extends('master')
 
@section('title', '')
 
@section('content')

<table class="table table-bordered data-table">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@endsection


@section('modal')

<div class="modal fade" id="detailModal" role="dialog">
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">User Detail</h4>
    </div>
    <div class="modal-body">

	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" value="" id="username">
	</div>

	<div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" value="" id="email">
	</div>

	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" value="" id="nama_lengkap">
	</div>

	<div class="form-group">
		<label>Tipe Akun</label>
		<input type="text" class="form-control" value="" id="tipe_akun">
	</div>

	<label>Alamat</label>
	<textarea class="form-control" placeholder="" rows="3" id="alamat"></textarea>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Delete</button>
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Update</button>
    </div>
  </div>
</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user') }}",
        columns: [
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });

function btnUbah(iduser){

	var iduser = iduser;
	$('#detailModal').modal('toggle');

	$.ajax({
	   type:'POST',
	   url: base_url + '/user/get-detail',
	   data:{iduser:iduser, "_token": "{{ csrf_token() }}",},
	   success:function(data) {
	      	$('#username').val(data.data.username);
	      	$('#email').val(data.data.email);
	   		$('#nama_lengkap').val(data.data.full_name);
	   		$('#tipe_akun').val();
	   		$('#alamat').val(data.data.address);
	   }
	});

}

</script>
@endpush