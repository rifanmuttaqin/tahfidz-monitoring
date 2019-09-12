@extends('master')

@section('title', '')

@section('content')

<div class="form-group">
	<label>Siswa</label>
    <select class="js-example-basic-single form-control" id="siswa_data" name="siswa_data" style="width: 100%"></select>
</div>

<div class="form-group col-md-6" style="padding-left: 0px">
	<label><strong>Tanggal Mulai</strong></label>
	<input autocomplete="off" type="text" name="startDate" class="form-control"/>
</div>

<div class="form-group col-md-6" style="padding-left: 0px">
	<label><strong>Tanggal Selesai</strong></label>
	<input autocomplete="off" type="text" name="endDate" class="form-control"/>
</div>

<div class="form-group" style="padding-top: 20px">
	<button type="submit" class="btn btn-info" id="tampil"> TAMPIL </button>
	<button type="submit" class="btn btn-info" id="print" style="display: none"> CETAK </button>
</div>

<div id="table_result">
    <div class="result"></div>
</div>
	
@endsection

@push('scripts')

<script type="text/javascript">

var start_date;
var end_date;
var siswa;

$( document ).ready(function() {

	$('#siswa_data').select2({
		allowClear: true,
		placeholder: 'Masukkan Nama Siswa',
		ajax: {
			url: base_url + '/parent/get-siswa',
			dataType: 'json',
			data: function(params) {
			    return {
			      search: params.term
			    }
			},
			processResults: function (data, page) {
			    return {
			        results: data
			    };
			}
		}
	});
	
	$( "#print" ).click(function() {
		window.location.href = '{{route("student-report-print")}}'; 
	})

	$( "#tampil" ).click(function() {
		
		siswa = $('#siswa_data').val();

		if(siswa == null)
		{
			swal('Tolong pilih siswa terlebih dahulu', { button:false, icon: "error", timer: 1000});
			return false;
		}

		$.ajax({
		    type:'POST',
		    url: '{{route("student-report-show")}}',
		    data:{
		      start_date:start_date,
		      end_date:end_date,
		      siswa:siswa,
		      "_token": "{{ csrf_token() }}",},
		    
		    success:function(response) {
		    	
		    	$(".result").html(response.data);
		    	
		    	if(response.status != false)
		    	{
		    		$( "#print" ).show();
		    	}
		    	else
		    	{
		    		$( "#print" ).hide();
		    	}
		    },
		    error: function(error) {
		      swal('Terjadi kegagalan sistem', { button:false, icon: "error", timer: 1000});
		    }
		}); 
	});

	$(function() {

		$('input[name="startDate"]').daterangepicker({
			drops: "up",
			autoApply: true,
			autoUpdateInput: false,
			singleDatePicker: true,
			locale: {
				cancelLabel: 'Clear',
			    format: 'DD/MMM/YYYY',
			},
			opens: 'top'
			}, function(start) {
				start_date = start.format('YYYY-MM-DD');
		});

		$('input[name="endDate"]').daterangepicker({
			drops: "up",
			autoApply: true,
			autoUpdateInput: false,
			singleDatePicker: true,
			locale: {
				cancelLabel: 'Clear',
			    format: 'DD/MMM/YYYY',
			},
			opens: 'top'
			}, function(start) {
				end_date = start.format('YYYY-MM-DD');
		});

		$('input[name="startDate"]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD/MMM/YYYY'));
			start_date = picker.startDate.format('YYYY-MM-DD');
		});

		$('input[name="endDate"]').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD/MMM/YYYY'));
			end_date = picker.startDate.format('YYYY-MM-DD');
		});
		
	});
});

</script>

@endpush