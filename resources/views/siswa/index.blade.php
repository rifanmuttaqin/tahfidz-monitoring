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
  <a  href="{{ route('create-siswa') }}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Jenis Hafalan</th>
            <th>Kelas</th>
            <th>Orang Tua</th>
            <th width="100px">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@endsection

@section('modal')




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
      ajax: "{{ route('siswa') }}",
      columns: [
          {data: 'siswa_name', name: 'siswa_name'},
          {data: 'memorization_type', name: 'memorization_type'},
          {data: 'class_id', name: 'class_id'},
          {data: 'parent_id', name: 'parent_id'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});


</script>

@endpush