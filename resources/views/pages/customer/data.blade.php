@extends('layouts.main')
@section('content')
<h1>Pelanggan</h1>
<hr>

<!-- Alert -->

	@if(session('status-alert') == 'sukses')
	<div class="alert alert-success alert-dismissable fade show" role="alert">
		<strong>Berhasil disimpan!</strong> Data telah berhasil disimpan kedalam database.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	@if(session('status-alert') == 'sukses-hapus')
	<div class="alert alert-success alert-dismissable fade show" role="alert">
		<strong>Berhasil dihapus!</strong> Data telah berhasil dihapus dari database.
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

	<!-- Pencarian dan Tambah -->

	<div class="row">
		<div class="col-sm-6 mb-3">
			<form method="get" action="?">
				<div class="input-group">
					<input type="text" name="cari" placeholder="Cari..." class="form-control" value="{{ $cari }}" />
					<div class="inout-group-append">
						<button type="submit" class="btn btn-primary">Go!</button>
					</div>
				</div>
			</form>
		</div>

		<div class="col-sm-6 text-right mb-3">
			<a href="{{ route('customer.tambah') }}" class="btn btn-primary">+Tambah</a>
		</div>

	</div>

	<!-- Data Tabel -->

	<?php
		$type = App\TransportationType::orderBy('description','asc')->get();
	?>
	<table class="table table-stripped table-sm">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Alamat</th>
				<th>P/L</th>
				<th>Telp</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>

		@foreach($data as $field)

			<tr>
				<td>
					<div class="btn-group">
						<button  type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
							Pesan Tiket
						</button>
						<div class="dropdown-menu">
							@foreach($type as $row)
								<a href="{{ route('reservation.pesan',['id_customer'=>$field->id,'id_type'=>$row->id]) }}" class="dropdown-item">
									{{ $row->description }}
								</a>
							@endforeach
						</div>
					</div>
					{{ $field->name }}
				</td>
				<td>
					{{ $field->address}}
				</td>
				<td>
					{{ $field->gender }}
				</td>
				<td>
					{{ $field->phone }}
				</td>
				
				<td class="text-right">
					<a href="{{ route('customer.edit',['id'=>$field->id]) }}" class="btn btn-sm btn-primary">
						<span class="fas fa-aw fa-edit"></span>
					</a>

					<button type="button" class="btn btn-sm btn-danger tombol-hapus" data-toggle="modal" data-target="#deleteModal" data-kodeid="{{ $field->id }}">
						<span class="fas fa-aw fa-trash-alt"></span>
					</button>			
					
				</td>
			</tr>

		@endforeach

		</tbody>
	</table>

	<!-- Halaman / Pagging -->
	{{ $data->appends(['cari'=>$cari])->links('vendor.pagination.bootstrap-4') }}

@endsection

@push('modal')

	<!-- Modal Hapus -->
	<div class="modal false" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModallabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Yakin mau dihapus?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Pilih "Hapus" apabila anda telah yakin untuk menghapusnya secara permanent.
				</div>
				<div class="modal-footer">
					<button class="btn btn-btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a href="#" class="btn btn-primary tombol-send-hapus">Hapus</a>
				</div>
			</div>	
		</div>
	</div>
@endpush

@push('js')

	<script >
		$(function () {
			$('.tombol-hapus').click(function () {
				var kd_id = $(this).attr('data-kodeid');
				var urlhapus = "{{ route('customer.hapus', ['id'=>':dataid']) }}";
				urlhapus = urlhapus.replace(':dataid',kd_id);
				$('.tombol-send-hapus').attr('href',urlhapus);
			});
		});
	</script>

@endpush