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
	<label><strong>Surat </strong></label>
	<select class="js-example-basic-single form-control" name="surah_id" id="surah_id" style="width: 100%;">
	<option></option>
	</select>
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

var kelas;
var surah; 

$( document ).ready(function() {

	$('#surah_id').select2({
      allowClear: true,
      ajax: {
        url: base_url + '/assessment/get-surah',
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
		window.location.href = '{{route("student-lack-report-print")}}'; 
	})

	$( "#tampil" ).click(function() {
		
		surah = $('#surah_id').val();
		kelas = $('#class_id').val();

		if(surah == null || kelas == null)
		{
			swal('Tolong isi inputan dengan lengkap', { button:false, icon: "error", timer: 1000});
			return false;
		}

		$.ajax({
		    type:'POST',
		    url: '{{route("student-lack-report-show")}}',
		    data:{
		      surah:surah,
		      kelas:kelas,
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
});

</script>

@endpush