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

<!-- <div style="padding-bottom: 20px">
  <a  href="{{ route('create-role') }}" type="button" class="btn btn-info"> TAMBAH </a>
</div> -->

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Aturan</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

@endsection

@section('modal')

@endsection

@push('scripts')

<script type="text/javascript">

var idrole;
var table;

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('role') }}",
      columns: [
          {data: 'name', name: 'name'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idrole)
{
  swal({
      title: "Menghapus",
      text: 'Apakah anda yakin ingin menghapus role ini ?', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/role/delete',
        data:{
          idrole:idrole, 
          "_token": "{{ csrf_token() }}",},
        success:function(data) {
          
          if(data.status != false)
          {
            swal(data.message, { button:false, icon: "success", timer: 1000});
          }
          else
          {
            swal(data.message, { button:false, icon: "error", timer: 1000});
          }

          table.ajax.reload();
        },
        error: function(error) {
          swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
        }
      });      
    }
  });
}

function btnDel(id)
{
  idrole = id;
  hapus(idrole);
}

function btnUbah(id){
  var url = '{{ route("update-role", ":id") }}';
  url     = url.replace(':id', id);
  window.location.href = url;
}

function clearAll()
{

}


</script>

@endpush