@extends('layouts.main')
@section('content')

	<h1>Pengguna</h1>
	<hr>

	<!-- Alert -->
	@if(session('status-alert') == 'sukses')
	<div class="alert alert-success alert-dismissable fade show" role="alert">
		<strong>Berhasil diupdate!</strong> Data berhasil diperbaharui pada database.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

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

	<div class="card border-info mb-3">
		<div class="card-header bg-info text-white">Setting Pengguna</div>
		<div class="card-body">
			<form method="post" action="{{ route('pengguna.setting.update') }}">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{ $field->id }}">
				<div class="form-group">
					<label>Nama</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" value="{{ Request::old('name', $field->fullname ) }}" required autofocus/>

							@if($errors->has('name'))
							<div class="invalid-feedback">
								{{ $errors->first('name')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 8-50, Contoh : Aji Putra Ramadhan
					</small>
				</div>

				<div class="form-group">
					<label>Username</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="username" class="form-control {{ $errors->has('username')?'is-invalid':'' }}" value="{{ Request::old('username',$field->username) }}" required autofocus/>

							@if($errors->has('username'))
							<div class="invalid-feedback">
								{{ $errors->first('username')}}
							</div>
							@endif

						</div>	
					</div>
					<small>
						Panjang Karakter 4-50, dan tidak boleh menggunakan spasi 
						<br>
						Contoh : ajipr , aji-pr , aji_pr , aji_10
					</small>
				</div>

				<div class="form-group">
					<label>Email</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" value="{{ Request::old('email', $field->email ) }}" required/>

							@if($errors->has('email'))
							<div class="invalid-feedback">
								{{ $errors->first('email')}}
							</div>
							@endif
							
						</div>	
					</div>
					<small>
						Panjang Karakter 8-50, Contoh : aji@gmail.com
					</small>
				</div>

				<div class="form-group">
					<label>Password</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" />
						</div>	

						@if($errors->has('password'))
							<div class="invalid-feedback">
								{{ $errors->first('password')}}
							</div>
							@endif

					</div>
					<small>
						Kosongkan Password apabila tidak ingin diganti
					</small>
				</div>

				<div class="form-group">
					<label>Ulangi Password</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="password" name="repassword" class="form-control {{ $errors->has('repassword')?'is-invalid':'' }}" />
						</div>

						@if($errors->has('repassword'))
							<div class="invalid-feedback">
								{{ $errors->first('repassword')}}
							</div>
							@endif

					</div>
				</div>

				<hr>
				<div class="form-group text-right">
					<p>
						Pilih "Simpan" apabila akan menyimpan data yang dimasukan pada formulir diatas.
					</p>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>

			</form>
		</div>
		<div class="card-footer bg-info"></div>
	</div>


@endsection