@extends('master')

@section('title', '')

@section('content')

<div class="form-group">
	<label><strong>Kelas</strong></label>
	<select class="js-example-basic-single form-control" name="class_id" id="class_id" style="width: 100%">
      <option></option>
    </select>
</div>

<div class="form-group">
	<label><strong>Jenis Hafalan</strong></label>
	<select class="form-control" name="memorization_type" id="memorization_type">
		<option value="{{ Siswa::TYPE_QURAN }}" >Alquran</option>
		<option value="{{ Siswa::TYPE_IQRO }}" >Iqro</option>
	</select>
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
var student_class;

$( document ).ready(function() {

	$('#class_id').select2({
		allowClear: true,
		ajax: {
		  url: base_url + '/siswa/get-class',
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
		window.location.href = '{{route("daily-report-print")}}'; 
	})

	$( "#tampil" ).click(function() {
		
		var memorization_type = $('#memorization_type').val();
		student_class = $('#class_id').val();

		if(student_class == null)
		{
			console.log(student_class);
			swal('Tolong pilih kelas terlebih dahulu', { button:false, icon: "error", timer: 1000});
			return false;
		}

		$.ajax({
		    type:'POST',
		    url: '{{route("daily-report-show")}}',
		    data:{
		      start_date:start_date,
		      end_date:end_date,
		      student_class:student_class,
		      memorization_type:memorization_type, 
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