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
  <a  href="{{route('create-iqro')}}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<div class="table-responsive">
<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nomor Jilid</th>
            <th>Total Halaman</th>
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
      <p class="modal-title">Detail Iqro</p>
    </div>
    <div class="modal-body">

    <div class="form-group">
      <label>Nomor Jilid</label>
      <input type="text" class="form-control" value="" name="jilid_number" id="jilid_number">
    </div>

    <div class="form-group">
      <label>Total Halaman</label>
      <input type="text" class="form-control" value="" name="total_page" id="total_page">
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

var idiqro;
var table;

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('iqro') }}",
      columns: [
          {data: 'jilid_number', name: 'jilid_number'},
          {data: 'total_page', name: 'total_page'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function hapus(idiqro)
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
        url: base_url + '/iqro/delete',
        data:{
          idiqro:idiqro, 
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
  idiqro = id;
  hapus(idiqro);
}

function btnUbah(id)
{
  idiqro = id;
  $.ajax({
     type:'POST',
     url: base_url + '/iqro/get-detail',
     data:{idiqro:idiqro, "_token": "{{ csrf_token() }}",},
     success:function(data) {
        $('#detailModal').modal('toggle');
        $('#jilid_number').val(data.data.jilid_number);
        $('#total_page').val(data.data.total_page);
     }
  });

  $('#hapus_action').click(function() {
    hapus(idiqro);
    $("#detailModal .close").click()
  })

  $('#update_data').click(function() {

    var jilid_number = $('#jilid_number').val();
    var total_page = $('#total_page').val();
    
    $.ajax({
      type:'POST',
      url: base_url + '/iqro/update',
      data:{
            idiqro:idiqro, 
            "_token": "{{ csrf_token() }}",
            jilid_number : jilid_number,
            total_page : total_page
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