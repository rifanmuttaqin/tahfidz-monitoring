@extends('master')
 
@section('title', '')

@section('alert')

@endsection
 
@section('content')


<fieldset>
<legend>Overview</legend>

<div class="col-md-4">
	<div class="card">
	    <div class="header">   
	        <p style="text-align: center; font-weight: bold;"> Siswa </p>
	    </div>
	    <div class="content">
	       <h3 style="text-align: center;"> {{ $siswa }} </h3>
	    </div>
	</div>
</div>

<div class="col-md-4">
	<div class="card">
	    <div class="header">   
	        <p style="text-align: center; font-weight: bold;"> Kelas </p>
	    </div>
	    <div class="content">
	       <h3 style="text-align: center;"> {{ $class }} </h3>
	    </div>
	</div>
</div>

<div class="col-md-4">
	<div class="card">
	    <div class="header">   
	        <p style="text-align: center; font-weight: bold;"> Hafalan {{ date("d M Y") }} </p>
	    </div>
	    <div class="content">
	       <h3 style="text-align: center;"> {{ $hafalan }} </h3>
	    </div>
	</div>
</div>


</fieldset>

<hr>

<fieldset>
<legend>Informasi User</legend>

</fieldset>

@endsection