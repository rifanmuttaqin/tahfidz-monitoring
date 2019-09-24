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

<div style="padding-bottom: 20px">
  <button type="button" class="btn btn-danger" id="reset">RESET</button>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th> Nama Aksi </th>
            <th> Pengguna </th>
            <th> Tanggal </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>



@endsection

@push('scripts')

<script type="text/javascript">

var table;

$( document ).ready(function() {
  $( "#reset" ).click(function() {
      
    $.ajax({
      type:'POST',
      url: base_url + '/action-log/remove',
      data:{
        
        "_token": "{{ csrf_token() }}",
      
      },
      success:function(data) {
        if(data.status != false)
        {
          table.ajax.reload();
          swal(data.message, { button:false, icon: "success", timer: 1000});
        }
        else
        {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      },
      error: function(error) {
        swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
      }
    });

  });
});

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('action-log') }}",
      columns: [
          {data: 'action_message', name: 'action_message'},
          {data: 'user', name: 'user'},
          {data: 'date', name: 'date'},
      ]
  });
});

</script>

@endpush