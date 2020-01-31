<!DOCTYPE html>
<html>
<head>
	<title>Laporan Harian</title>
</head>
<style>

	#table_style {
	  font-family: DejaVu Sans, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	  padding-top: 20px;
	}

	#table_style td, #table_style th {
	  border: 1px solid #ddd;
	  padding: 8px;
	}

	#table_style tr:nth-child(even){background-color: #f2f2f2;}

	#table_style tr:hover {background-color: #ddd;}

	#table_style th {
	  padding-top: 12px;
	  padding-bottom: 12px;
	  text-align: left;
	  background-color: #4CAF50;
	  color: white;
	}

</style>
<body>

<div style="text-align: center; line-height: 1.5;">
	<p> 
		<h4> Laporan Rekap Siswa / Siswi Kelas {{ $class_id }} <br>
		Periode {{ date('d M Y', strtotime($start_date)) }} Sampai dengan {{ date('d M Y', strtotime($end_date)) }} <h4>
	<p>
</div>

<hr>

<table id="table_style">
<thead>
	<tr>
	<th> Siswa </th>
	<th> Surat / Jilid </th>
	<th> Ayat / Halaman </th>
	<th> Note / Nilai </th>
	<th> Tanggal </th>
	</tr>
</thead>
<tbody>

<?= $old_assessment = null; ?>

<?php foreach ($data as $assessment) { ?>

    <tr>

    @if ($assessment->siswa_id != $old_assessment)
   
        <td>{{ $assessment->getSiswa->siswa_name }}</td>
        
        <?php $old_assessment = $assessment->siswa_id; ?>
   
   	@else
        <td></td>
    @endif
    
    <td>{{ $assessment->assessment }}</td>
    <td>{{ $assessment->range }}</td>
    <td>{{ $assessment->note }}</td>
    <td>{{ date('d M Y', strtotime($assessment->date)) }}</td>
    
    </tr>

<?php } ?>

</tbody>
</table>	
</html>