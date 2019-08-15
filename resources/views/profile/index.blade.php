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

<form method="post" action="{{ route('update-profile') }}">

    @csrf
    <div class="form-group">
      <label>Nama Lengkap</label>
      <input type="text" value="{{ $data_user->full_name }}" class="form-control" value="" name="full_name">
      @if ($errors->has('full_name'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('full_name') }}</p></div>
      @endif
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="text" value="{{ $data_user->email }}" class="form-control" value="" name="email">
      @if ($errors->has('email'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('email') }}</p></div>
      @endif
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <input type="text" value="{{ $data_user->address }}" class="form-control" value="" name="address">
      @if ($errors->has('address'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('address') }}</p></div>
      @endif
    </div>

    <input type="hidden" value="{{ $data_user->id }}" class="form-control" value="" name="iduser">
  
    <div class="form-group">
      <button type="submit" class="btn btn-info"> UPDATE </button>
      <button type="button" id="change_pass" class="btn btn-info pull-right"> UBAH PASSWORD </button>
    </div>

  </form>

@endsection

@section('modal')

<div class="modal fade" id="passwordModal" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title">Ubah Password</p>
      </div>
      <div class="modal-body">
        
        <div class="form-group col-md-12">
          <label>Password Lama</label>
          <input type="password" class="form-control" value="" id="old_password" name="old_password">
        </div>

        <div class="form-group col-md-6">
          <label>Password</label>
          <input type="password" class="form-control" value="" id="password" name="password">
        </div>

        <div class="form-group col-md-6">
          <label>Re Password</label>
          <input type="password" class="form-control" value="" id="password_confirmation" name="password_confirmation">
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="modal-footer">
        <button type="button" id="update_password" class="btn btn-default pull-left">Update</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

var idiqro;
var table;

$( document ).ready(function() {
  
  $('#change_pass').click(function() { 
    $('#passwordModal').modal('toggle');
  })

  $('#update_password').click(function() { 

  var old_password = $('#old_password').val();
  var password = $('#password').val();
  var password_confirmation = $('#password_confirmation').val();

   $.ajax({
      type:'POST',
      url: base_url + '/profile/update-password',
      data:
      {
        "_token": "{{ csrf_token() }}",
        password : password,
        password_confirmation : password_confirmation,
        old_password : old_password
      },
      success:function(data) {
        if(data.status != false)
        {
          swal(data.message, { button:false, icon: "success", timer: 1000});
          $("#passwordModal .close").click()
        }
        else
        {
          swal(data.message, { button:false, icon: "error", timer: 1000});
        }
      },
        error: function(error) {
          var err = eval("(" + error.responseText + ")");
          var array_1 = $.map(err, function(value, index) {
              return [value];
          });
          var array_2 = $.map(array_1, function(value, index) {
              return [value];
          });
          var message = JSON.stringify(array_2);
          swal(message, { button:false, icon: "error", timer: 1000});
        }
    });
  })

});


</script>

@endpush