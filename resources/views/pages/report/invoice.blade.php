@extends('layouts.report')
@section('content')

<h3>Tiket - A Tour</h3>

<?php
$tool = new App\Library\Tools;
?>

<div class="row">
	<div class="col">
		Nama : <br> <strong>{{$field->name}}</strong>
	</div>
	<div class="col-4">
		No : <br><strong>{{$field->reservation_code}}</strong>
	</div>
</div>
<hr>
<div class="row">
	<div class="col">
		Nama Transportasi : 
		<br><strong>
			{{$field->code}}
		</strong>
	</div>
	<div class="col-4">
		Tipe Transportasi :
		<br><strong>
			{{$field->type}}
			<span class="fas fa-aw fa-arrow-alt-circle-right text-primary"></span>
			{{$field->description}}
		</strong>
	</div>
</div>
<hr>
<div class="row">
	<div class="col">
		Jadwal Berangkat : 
		<br><strong>{{$tool->dateformat($field->depart_at,'D, d M Y - H:i:s')}}</strong>	
		<br><strong>{{$field->rute_from}}</strong>
	</div>
	<div class="col-4">
		Jadwal Tiba : 
		<br><strong>{{$tool->interval($field->depart_at,$field->depart_at_rute,'D, d M Y - H:i:s')}}</strong>
		<br><strong>{{$field->rute_to}}</strong>
	</div>
</div>
<hr>
<div class="row">
	<div class="col">
		Kode Tempat Duduk	: <strong>{{$field->seat_code}}</strong><br>
		Harga 				: <strong>Rp. {{number_format($field->price,0,',','.')}} ,-</strong>
	</div>
	<div class="col-4">
		Dilayani oleh	:<strong> {{ $field->fullname}}</strong> <br>
		Pada tanggal	:<strong> 
		<?php
			$date = $field->reservation_date.''.$field->reservation_at;
		?>
		{{$tool->dateformat($date,'D, d M Y - H:i:s')}}
		</strong>
	</div>
</div>
<hr>
<p><i><h5>Terima Kasih sudah memakai jasa kami :)</h5></i></p>

@endsection

@push('css')

<style type="text/css">
	hr{
		margin-bottom: 5px;
		margin-top: 5px;
	}
	.row strong{
		font-family: Arial;
		font-size: 20px;
	}
</style>

@endpush