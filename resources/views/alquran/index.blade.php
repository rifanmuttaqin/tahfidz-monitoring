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
  <a  href="{{route('create-alquran')}}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Surah</th>
            <th>Total Ayat</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

@endsection

@section('modal')

<div class="modal fade" id="detailModal" role="dialog" >
<div class="modal-dialog modal-md">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <p class="modal-title">Detail Alquran</p>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nama Surat</label>
      <input type="text" class="form-control" value="" name="surah_name" id="surah_name">
    </div>

    <div class="form-group">
      <label>Total Ayat</label>
      <input type="text" class="form-control" value="" name="total_ayat" id="total_ayat">
    </div>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-right" id="hapus_action">Hapus</button>
      <button type="button" id="update_data" class="btn btn-default pull-left">Update</button>
    </div>
  </div>
</div>
</div>

@endsection

@push('scripts')

<script type="text/javascript">

var idsurah;
var table;

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('alquran') }}",
      columns: [
          {data: 'surah_name', name: 'surah_name'},
          {data: 'total_ayat', name: 'total_ayat'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idsurah)
{
  swal({
      title: "Menghapus",
      text: 'Apakah anda yakin ingin menghapus ini ?', 
      icon: "warning",
      buttons: true,
      dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        type:'POST',
        url: base_url + '/alquran/delete',
        data:{
          idsurah:idsurah, 
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
  idsurah = id;
  hapus(idsurah);
}

function btnUbah(id)
{
  idsurah = id;
  $.ajax({
     type:'POST',
     url: base_url + '/alquran/get-detail',
     data:{idsurah:idsurah, "_token": "{{ csrf_token() }}",},
     success:function(data) {
        $('#detailModal').modal('toggle');
        $('#surah_name').val(data.data.surah_name);
        $('#total_ayat').val(data.data.total_ayat);
     }
  });

  $('#hapus_action').click(function() {
    hapus(idsurah);
    $("#detailModal .close").click()
  })

  $('#update_data').click(function() {

    var surah_name = $('#surah_name').val();
    var total_ayat = $('#total_ayat').val();
    
    $.ajax({
      type:'POST',
      url: base_url + '/alquran/update',
      data:{
            idsurah:idsurah, 
            "_token": "{{ csrf_token() }}",
            surah_name : surah_name,
            total_ayat : total_ayat
      },
     success:function(data) {
        if(data.status != false)
        {
          swal(data.message, { button:false, icon: "success", timer: 1000});
          $("#detailModal .close").click()
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
  })

}

</script>

@endpush