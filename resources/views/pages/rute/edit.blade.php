@extends('layouts.main')
@section('content')
<h1>Rute</h1>
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
	<div class="card border-info mb-3">
		<div class="card-header bg-info text-white">Tambah Rute</div>
		<div class="card-body">
			<form method="post" action="{{ route('rute.update') }}">
			{{csrf_field()}}

				<input type="hidden" name="id" value="{{$field->id}}">
				<div class="form-group">
					<label>Transportasi</label>
					<div class="row">
						<div class="col-sm-6">
						<select name="transportasi" class="form-control" {{$errors->has('transportasi'?'is-invalid':'')}}>
							<option value="">Pilih :</option>
							<?php
								$val = Request::old('transportasi',$field->transportationid);
								$res = App\Transportation::join(
										'transportation_type',
										'transportation_type.id',
										'=',
										'transportation.transportation_typeid'
									)
								->select(
										'transportation_type.*',
										'transportation.*',
										'transportation.id as id',
										'transportation_type.id as id_type',
										'transportation_type.description as type',
										'transportation.description as transportation'
									)
								->orderBy('transportation_type.description','asc')
								->get();
							?>

							@foreach($res as $opt)
								<option value="{{$opt->id}}" {{$opt->id == $val?'selected':''}}>
									{{$opt->type}} | {{$opt->code}}
								</option>
							@endforeach

						</select>
							

							@if($errors->has('transportasi'))
							<div class="invalid-feedback">
								{{ $errors->first('transportasi')}}
							</div>
							@endif

						</div>	
					</div>
					
				</div>

				<div class="form-group">
					<label>Berangkat Dari</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="rute_from" class="form-control {{ $errors->has('rute_from')?'is-invalid':'' }}" value="{{ Request::old('rute_from',$field->rute_from) }}" required />

							@if($errors->has('rute_from'))
							<div class="invalid-feedback">
								{{ $errors->first('rute_from')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 3-50, Contoh : Bandung
					</small>
				</div>

				<div class="form-group">
					<label>Tujuan ke</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="rute_to" class="form-control {{ $errors->has('rute_to')?'is-invalid':'' }}" value="{{ Request::old('rute_to',$field->rute_to) }}" required />

							@if($errors->has('rute_to'))
							<div class="invalid-feedback">
								{{ $errors->first('rute_to')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 3-50, Contoh : Yogyakarta
					</small>
				</div>

				<div class="form-group">
					<label>Lama Perjalanan (Jam)</label>
					<div class="row">
						<div class="col-sm-2">
							<input type="number" name="lama" class="form-control {{ $errors->has('lama')?'is-invalid':'' }}" value="{{ Request::old('lama',$field->depart_at) }}" required />

							@if($errors->has('lama'))
							<div class="invalid-feedback">
								{{ $errors->first('lama')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 1-3, Contoh : 2
					</small>
				</div>

				<div class="form-group">
					<label>Harga</label>
					<div class="row">
						<div class="col-sm-3">
							<input type="number" name="harga" class="form-control {{ $errors->has('harga')?'is-invalid':'' }}" value="{{ Request::old('harga',$field->price) }}" required />

							@if($errors->has('harga'))
							<div class="invalid-feedback">
								{{ $errors->first('harga')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 5-10, Contoh : 150000
					</small>
				</div>			

				<hr>
				<div class="form-group text-right">
					<p>
						Pilih "Simpan" apabila akan menyimpan data yang dimasukan pada formulir diatas.
					</p>
					<a href="{{ route('rute.data') }}" class="btn btn-secondary">Cancel</a>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>

			</form>
		</div>
		<div class="card-footer bg-info"></div>
	</div>
@endsection