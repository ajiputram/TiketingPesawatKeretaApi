@extends('layouts.main')
@section('content')

	<h1>Pengguna</h1>
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

	<div class="card border-info mb-3">
		<div class="card-header bg-info text-white">Tambah Pengguna</div>
		<div class="card-body">
			<form method="post" action="{{ route('pengguna.simpan') }}">
			{{csrf_field()}}
				<div class="form-group">
					<label>Nama</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" value="{{ Request::old('name') }}" required autofocus/>

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
							<input type="text" name="username" class="form-control {{ $errors->has('username')?'is-invalid':'' }}" value="{{ Request::old('username') }}" required autofocus/>

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
							<input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" value="{{ Request::old('email') }}" required/>

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
					<label>Level</label>
					<div class="row">
						<?php
							$val = Request::old('level');
						?>
						<div class="col-sm-3">
							<select name="level" class="form-control {{ $errors->has('level')?'is-invalid':'' }}" required>
								<option value="" {{$val==''?'selected':''}}>Pilih:</option>
								<option value="Admin" {{$val=='Admin'?'selected':''}}>Admin</option>
								<option value="Operator" {{$val=='Operator'?'selected':''}}>Operator</option>
							</select>

							@if($errors->has('level'))
							<div class="invalid-feedback">
								{{ $errors->first('level')}}
							</div>
							@endif

						</div>	
					</div>
				</div>

				<div class="form-group">
					<label>Password</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" required/>
						</div>	

						@if($errors->has('password'))
							<div class="invalid-feedback">
								{{ $errors->first('password')}}
							</div>
							@endif

					</div>
					<small>
						Panjang Karakter minimal 6.
					</small>
				</div>

				<div class="form-group">
					<label>Ulangi Password</label>
					<div class="row">
						<div class="col-sm-6">
							<input type="password" name="repassword" class="form-control {{ $errors->has('repassword')?'is-invalid':'' }}" required/>
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
					<a href="{{ route('pengguna.data') }}" class="btn btn-secondary">Cancel</a>
					<button type="submit" class="btn btn-info">Simpan</button>
				</div>

			</form>
		</div>
		<div class="card-footer bg-info"></div>
	</div>


@endsection