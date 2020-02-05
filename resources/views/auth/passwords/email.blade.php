@extends('master_reset_password')

@section('content')

     <form id="register-form" autocomplete="off" method="POST" action="{{ route('password.email') }}">
       
        @csrf

        <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
          <input id="email" name="email" placeholder="alamat email" class="form-control"  type="email">
        </div>
        </div>
        
        <div class="form-group">                       
            <button type="submit" class="btn btn-primary">
                Kirim
            </button>
        </div>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

    </form>
                
@endsection
