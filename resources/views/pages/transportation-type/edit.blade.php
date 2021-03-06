@extends ('layouts.main')
@section('content')

<h1>Tipe Transportasi</h1>
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
		<div class="card-header bg-info text-white">Edit Tipe Transportasi</div>
		<div class="card-body">
			<form method="post" action="{{ route('transportation-type.update') }}">
			{{csrf_field()}}
				<input type="hidden" name="id" value="{{$field->id}}" />
				<div class="form-group">
					<label>Deskripsi</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="deskripsi" class="form-control {{ $errors->has('deskripsi')?'is-invalid':'' }}" value="{{ Request::old('deskripsi',$field->description) }}" required autofocus/>

							@if($errors->has('deskripsi'))
							<div class="invalid-feedback">
								{{ $errors->first('deskripsi')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 3-50, Contoh : Kereta
					</small>
				</div>			

				<hr>
				<div class="form-group text-right">
					<p>
						Pilih "Simpan" apabila akan menyimpan data yang dimasukan pada formulir diatas.
					</p>
					<a href="{{ route('transportation-type.data') }}" class="btn btn-secondary">Cancel</a>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>

			</form>
		</div>
		<div class="card-footer bg-info"></div>
	</div>

@endsection