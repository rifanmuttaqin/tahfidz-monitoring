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
  <a  href="{{ route('create-student-class') }}" type="button" class="btn btn-info"> TAMBAH </a>
</div>

<table class="table table-bordered data-table display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>Angkatan</th>
            <th>Kelas</th>
            <th>Guru</th>
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

var idclass;
var table;

function clearAll(){
  
}

$(function () {
  table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      rowReorder: {
          selector: 'td:nth-child(2)'
      },
      responsive: true,
      ajax: "{{ route('student-class') }}",
      columns: [
          {data: 'angkatan', name: 'angkatan'},
          {data: 'class_name', name: 'class_name'},
          {data: 'guru', name: 'guru'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
  });
});

function btnDel(id)
{
  
}

function btnUbah(id){

	
}

</script>

@endpush