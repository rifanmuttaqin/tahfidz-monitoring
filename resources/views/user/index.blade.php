@extends('master')
 
@section('title', '')
 
@section('content')

<div style="padding-bottom: 20px">
  <a  href="{{ route('create') }}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<table class="table table-bordered data-table display nowrap" style="width:100%">
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
		<input type="text" class="form-control" value="" id="tipe_akun" disabled>
	</div>

	<label>Alamat</label>
	<textarea class="form-control" placeholder="" rows="3" id="alamat"></textarea>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Delete</button>
      <button type="button" id="update_data" class="btn btn-default pull-left">Update</button>
    </div>
  </div>
</div>
</div>


<div class="modal fade" id="updatePassword" role="dialog">
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Update Password</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" value="" id="username_password" disabled>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" class="form-control" value="" id="password">
        </div>

        <div class="form-group">
          <label>Re Password</label>
          <input type="password" class="form-control" value="" id="password_confirmation">
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" id="update_data_password" class="btn btn-default pull-left">Update Password</button>
    </div>
  </div>
</div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

var iduser;
var table;

function clearAll(){
  $('#username').val('');
  $('#tipe_akun').val('');
  $('#email').val('');
  $('#nama_lengkap').val('');
  $('#alamat').val('');
}

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('user') }}",
      columns: [
          {data: 'full_name', name: 'full_name'},
          {data: 'email', name: 'email'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function btnPass(id){

  $('#updatePassword').modal('toggle');

  iduser = id;

  $.ajax({
     type:'POST',
     url: base_url + '/user/get-detail',
     data:{iduser:iduser, "_token": "{{ csrf_token() }}",},
     success:function(data) {
        $('#username_password').val(data.data.username);
     }
  });

  $('#update_data_password').click(function() {

    var password = $('#password').val();
    var password_confirmation = $('#password_confirmation').val();

    $.ajax({
      type:'POST',
      url: base_url + '/user/update-password',
      data:
      {
        iduser:iduser, 
        "_token": "{{ csrf_token() }}",
        password : password,
        password_confirmation : password_confirmation,
      },
      success:function(data) {

        if(data.status != false)
        {
          swal(data.message, { button:false, icon: "success", timer: 1000});
          $("#updatePassword .close").click()
        }
        else
        {
          swal(data.message, { button:false, icon: "error", timer: 1000});
        }

      }
    });
  })
}

function btnUbah(id){

	$('#detailModal').modal('toggle');
  
  iduser = id;

	$.ajax({
	   type:'POST',
	   url: base_url + '/user/get-detail',
	   data:{iduser:iduser, "_token": "{{ csrf_token() }}",},
	   success:function(data) {
	      $('#username').val(data.data.username);
        $('#tipe_akun').val(data.data.account_type);
	      $('#email').val(data.data.email);
	   		$('#nama_lengkap').val(data.data.full_name);
	   		$('#alamat').val(data.data.address);
	   }
	});

  $('#update_data').click(function() { 

      var username = $('#username').val();
      var email = $('#email').val();
      var full_name = $('#nama_lengkap').val();
      var address = $('#alamat').val();

      $.ajax({
        type:'POST',
        url: base_url + '/user/update',
        data:{
          iduser:iduser, 
          "_token": "{{ csrf_token() }}",
          username : username,
          email : email,
          full_name : full_name,
          address : address
        },
        success:function(data) {

          if(data.status != false)
          {
            table.ajax.reload();
            clearAll();
            swal(data.message, { button:false, icon: "success", timer: 1000});
            $("#detailModal .close").click()
          }

        }
      });
  })

}

</script>

@endpush