<?php
	use Yajra\Datatables\Datatables;
?>

@extends('master')
 
@section('title', '')
 
@section('content')

<table class="table table-bordered data-table">
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

@push('scripts')
<script type="text/javascript">

  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user') }}",
        columns: [
            {data: 'full_name', name: 'full_name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });

</script>
@endpush