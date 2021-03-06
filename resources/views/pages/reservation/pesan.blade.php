@extends('layouts.main')
@section('content')

<h1>Reservasi</h1>
<hr>

<!-- Alert -->
	@if(session('status-alert') == 'peringatan')
	<div class="alert alert-warning alert-dismissable fade show" role="alert">
		<strong>Oups,ada kesalahan!</strong> Data gagal disimpan karena ada kesalahan, silahkan diperiksa kembali.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@if(session('status-alert') == 'gagal')
	<div class="alert alert-danger alert-dismissable fade show" role="alert">
		<strong>Gagal dihapus!</strong> Data gagal dihapus pada database, silahkan ulangi kembali.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	<!-- Formulir -->
	<?php

		$tool = new App\Library\Tools;

		$pelanggan = App\Customer::where('id',$id_customer)->first();

		$rute = App\Rute::join('transportation','transportation.id','rute.transportationid')
				->join( 'transportation_type',
						'transportation_type.id',
						'transportation.transportation_typeid'
					)
				->select(
						'rute.*',
						'transportation.*',
						'transportation_type.*',
						'rute.id as id',
						'transportation.id as id_transportation',
						'transportation_type.id as id_type',
						'transportation.description as desc_transportation',
						'transportation_type.description as type'
					)
				->where('transportation_typeid',$id_type)
				->orderBY('rute.rute_from','asc')
				->get()

	?>

	<div class="card border-info mb-3">
		<div class="card-header bg-info text-white">Pesan Tiket - A Tour</div>
		<div class="card-body">
			<form method="post" action="{{ route('reservation.simpan') }}">
			{{csrf_field()}}
				<input type="hidden" name="id_customer" value="{{ $id_customer }}">
				<input type="hidden" name="id_type" value="{{ $id_type }}">
				<input type="hidden" name="kode_reservasi" value="{{ $tool->coderes() }}">
				<input type="hidden" name="harga" id="harga">	
						

				<div class="form-row">
					<div class="form-group col-sm-4">
						<label>Nama</label>
						<input type="text" class="form-control" value="{{ $pelanggan->name }}" disabled>
					</div>

					<div class="form-group col-sm-4 offset-sm-2">
						<label>Kode Reservasi</label>
						<input type="text" class="form-control" value="{{ $tool->coderes() }}" disabled>
					</div>
				</div>

				<div class="form-row">
					<div class="col-sm-6">
						<div class="form-row">
							<div class="form-group col-sm-8">
								<label>Rute</label>
								<select name="rute" id="rute" class="form-control {{$errors->has('rute'?'is-invalid':'')}}" required>
									<option value="">Pilih : </option>
									<?php
										$val = Request::old('rute');
									?>
									@foreach($rute as $row)
									<option value="{{$row->id}}" {{ $val == $row->id ? 'selected':''}}>
										{{ $row->rute_from }} -> {{ $row->rute_to }} / {{ $row->code }}
									</option>
									@endforeach
								</select>
								@if($errors->has('rute'))
									<div class="invalid-feedback">
										{{ $errors->first('rute') }}
									</div>
								@endif
							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-6">
								<label>Kode Tempat Duduk</label>
								<input type="text" name="tempat_duduk" value="{{Request::old('tempat_duduk')}}" class="form-control {{$errors->has('tempat_duduk')?'is-invalid':''}}" required>

								@if($errors->has('tempat_duduk'))
									<div class="invalid-feedback">
										{{ $errors->first('tempat_duduk') }}
									</div>
								@endif
								<small class="text-muted">
									Panjang Karakter 2-10, Contoh : KA01 , PT01
								</small>

							</div>
						</div>

						<div class="form-row">
							<div class="form-group col-sm-6">
								<label>Tanggal / Jadwal Berangkat</label>
								<div class="input-group date" id="tanggal" data-target-input="nearest">								
				 					<input type="text" name="tanggal" value="{{Request::old('tanggal')}}" class="form-control {{$errors->has('tanggal')?'is-invalid':''}}" data-target="#tanggal" required>
									<div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
										<span class="input-group-text">
											<i class="fa fa-aw fa-calendar-alt text-primary"></i>
										</span>
									</div>
										@if($errors->has('tanggal'))
										<div class="invalid-feedback">
										{{ $errors->first('tanggal') }}
										</div>
										@endif
										</div>
										<small class="text-muted">
										Contoh : 2018-10-31 22:35:15
										</small>
										
								</div>
							</div>
						</div>
						

					<div class="col-sm-6">
						<div class="card border-primary mt-3">
						<div class="card-header bg-light text-primary">Keterangan</div>
							<div class="card-body">
								<table cellpadding="4">
									<tr>
										<td>Kode / Nama Transportasi</td>
										<td>: <span id="code"></span></td>
									</tr>
									<tr>
										<td>Tipe</td>
										<td>: <span id="type"></span></td>
									</tr>
									<tr>
										<td>Deskripsi</td>
										<td>: <span id="desc"></span></td>
									</tr>
									<tr>
										<td>Rute</td>
										<td>: 
											<span id="dari"></span>
											<span class="fas fa-aw fa-arrow-alt-circle-right text-primary"></span>
											<span id="ke"></span>
										</td>
									</tr>
									<tr>
										<td>Harga</td>
										<td>: <span id="harga_format"></span></td>
									</tr>
								</table>		
							</div>
						</div>
					</div>

				</div>


				<hr>
				<div class="form-group text-right">
					<p>
						Pilih "Simpan" apabila akan menyimpan data yang dimasukan pada formulir diatas.
					</p>
					<a href="{{ route('reservation.data') }}" class="btn btn-secondary">Cancel</a>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>

			</form>
		</div>
		<div class="card-footer bg-info"></div>
	</div>

@endsection


@push('js')
<script type="text/javascript">
	var obj = [
			{
				code : "",
				type : "",
				harga : "",
				harga_format : "",
				desc : "",
				dari : "",
				ke : "",
		},
		@foreach($rute as $row)
			{
				code : "{{ $row->code }}",
				type : "{{ $row->type }}",
				harga : "{{ $row->price }}",
				harga_format : "{{ number_format($row->price,0,',','.' )}}",
				desc : "{{ $row->desc_transportation }}",
				dari : "{{ $row->rute_from }}",
				ke : "{{ $row->rute_to }}",
			},
		@endforeach
	];

	$(function() {
		imRute();
		$('#rute').on('change',function(){
			imRute();
		});
	});

	function imRute(){
		var idx = $('#rute')[0].selectedIndex;
		$('#code').html(obj[idx].code);
		$('#type').html(obj[idx].type);	
		$('#dari').html(obj[idx].dari);
		$('#desc').html(obj[idx].desc);
		$('#ke').html(obj[idx].ke);
		$('#harga_format').html(obj[idx].harga_format);
		$('#harga').val(obj[idx].harga);
	}
</script>

<script type="text/javascript" src="{{url('vendor/tempusdominus/js/moment.min.js')}}" ></script>
<script type="text/javascript" src="{{url('vendor/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}" ></script>

<script type="text/javascript">
	$(function () {
		$('#tanggal').datetimepicker({
			icons : {
			time : "fa fa-aw fa-clock text-primary",
			date : "fa fa-aw fa-calendar-alt text-primary",
			up : "fa fa-aw fa-arrow-up",
			down : "fa fa-aw fa-arrow-down",
		},
			format : "YYYY-MM-DD HH:mm:ss",
		});
	});
</script>
@endpush

@push ('css')

	<link rel="stylesheet" type="text/css" href="{{ url('vendor/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}">

@endpush