@extends('master')

@section('title', '')

@section('content')

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

  <form method="post" action="{{route('do-assessment')}}">

    @csrf

    <div class="form-group">
      <label>Nama Santri / Siswa</label>
      <input type="text" class="form-control" value="{{ $data_siswa->siswa_name }}" disabled>
    </div>

    <div class="form-group">
      <label>Iqro</label>
      <select class="form-control" name="iqro_id" id="iqro_id">
        <option value=""></option>
        @foreach ($iqro_arr as $key => $iqro)
          <option value="{{ $key }}" >{{ $iqro }}</option>
        @endforeach
      </select>
      @if ($errors->has('iqro_id'))
        <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('iqro_id') }}</p></div>
      @endif
    </div>

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Mulai Halaman</label>
        <input class="form-control" id="begin" name="begin">
        @if ($errors->has('begin'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('begin') }}</p></div>
        @endif
    </div>

    <div class="form-group col-md-6" style="padding-left: 0px">
      <label>Sampai Halaman</label>
        <input class="form-control" id="end" name="end">
        @if ($errors->has('end'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('end') }}</p></div>
        @endif
    </div>

    <div class="form-group">
      <label>Catatan </label>
      <input type="text" class="form-control" name="note">
      @if ($errors->has('note'))
          <div class="error"><p style="color: red"><span>&#42;</span> {{ $errors->first('note') }}</p></div>
      @endif
    </div>
      
    <div class="form-group" id="submit_yes" style="padding-top: 20px; padding-bottom: 20px">
      <button type="submit" class="btn btn-info" value="text 1"> VALIDASI SELESAI </button>
    </div>

    <div class="form-group">
      <input type="hidden" class="form-control" name="id_siswa" value="{{ $data_siswa->id }}">
    </div>

  </form>

  <hr>

  <div class="table-responsive">
  <table class="table table-bordered data-table display nowrap" style="width:100%">
  <thead>
      <tr>
          <th width="30%">Iqro </th>
          <th width="20%">Halaman </th>
          <th width="20%">Note / Nilai </th>
          <th width="50%">Tanggal </th>
      </tr>
  </thead>
  <tbody>
  </tbody>
  </table>
  </div>
  
@endsection

@push('scripts')

<script type="text/javascript">

var total_page;
var table;
var id_siswa = '{{ $data_siswa->id }}';

$(function () {
    
    var url = '{{ route("create-assessment", ":id") }}';
    url = url.replace(':id', id_siswa);
    
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        bFilter: false,
        bInfo: false,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        "aaSorting": [[ 3, "desc" ]],
        ajax: url,
        columns: [
            {data: 'assessment', name: 'assessment'},
            {data: 'range', name: 'range'},
            {data: 'note', name: 'note'},
            {data: 'date', name: 'date'},
        ]
    });
  });

$(document).ready(function() {

  $( "#iqro_id" ).change(function() {
        
        iqro_id = $(this).val();
        
        $.ajax({
        type:'GET',
        url: base_url + '/assessment/get-total-page',
        data:{
              iqro_id:iqro_id, 
              "_token": "{{ csrf_token() }}",
        },
       success:function(data) {
         total_page = data;
       },
       error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });
    });

  // $('#begin').on('input', function () {
  //   var value = $(this).val();
  //   if ((value !== '') && (value.indexOf('.') === -1)) {
  //       $(this).val(Math.max(Math.min(value, total_page), 0));
  //   }
  // });

  // $('#end').on('input', function () {
  //   var value = $(this).val();
  //   if ((value !== '') && (value.indexOf('.') === -1)) {
  //       $(this).val(Math.max(Math.min(value, total_page), 0));
  //   }
  // });

})

</script>

@endpush