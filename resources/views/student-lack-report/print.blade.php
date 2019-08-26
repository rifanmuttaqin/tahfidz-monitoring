<?php 

use App\Model\SiswaHasSurah\SiswaHasSurah;
use App\Model\StudentClass\StudentClass;
use App\Model\Surah\Surah;

?>

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
		<h4> Laporan Rekap Kekurangan {{ $class_id }} <br>
		Surat {{ Surah::findOrFail($surah)->surah_name }} <h4> 
	<p>
</div>

<hr>

<table id="table_style">
<thead>
	<tr>
	<th> Nama Siswa/Siswi </th>
	<th> Yang Diselesaikan </th>
	<th> Kekurangan </th>
	</tr>
</thead>
<tbody>

<?php foreach ($data_siswa as $siswa) { ?>

	<?php 

	$data_assessment_siswa = SiswaHasSurah::where('surah_id',$surah)
	->where('siswa_id',$siswa->id)->get();

	$lack_list = [];

	foreach ($data_assessment_siswa as $assessment) 
	{
	    array_push($lack_list, $assessment->ayat);
	}

	$max = 0;
	$min = 0;

	if($lack_list != null)
	{
	    $max = max($lack_list);
	    $min = min($lack_list);
	}  

	$begin = $max + 1;
	$end = $surah_max_ayat - $max;

	echo '<tr>';               
	echo '<td>'.$siswa->siswa_name.'</td>';
	echo '<td> Antara Ayat '.$min.' - '.$max.'</td>';

	if($end != 0)
	{
	    echo '<td> Antara Ayat '.$begin.' - '. $end .'</td>';
	}
	else
	{
	    echo '<td> Selesai </td>';
	}

	echo '</tr>';

	}
?>

</tbody>
</table>	
	
</html>