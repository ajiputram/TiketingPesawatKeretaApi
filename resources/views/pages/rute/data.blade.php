@extends('layouts.main')
@section('content')

<h1>Rute</h1>
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
			<form method="get" action="?" class="form-inline">
			<select class="form-control mr-2" name="tipe">
				<?php
					$val = $tipe;
					$res = App\TransportationType::orderBy('description','asc')->get();
				?>
				<option value="" {{$val==''?'selected':''}}>Semua Tipe</option>
				@foreach($res as $opt)
					<option value="{{$opt->id}}" {{$val==$opt->id?'selected':''}}>
						{{$opt->description}}
					</option>
				@endforeach
			</select>
				<div class="input-group">
					<input type="text" name="cari" placeholder="Cari..." class="form-control" value="{{ $cari }}" />
					<div class="inout-group-append">
						<button type="submit" class="btn btn-primary">Go!</button>
					</div>
				</div>
			</form>
		</div>

		<div class="col-sm-6 text-right mb-3">
			<a href="{{ route('rute.tambah') }}" class="btn btn-primary">+Tambah</a>
		</div>

	</div>

	<!-- Data Tabel -->
	<table class="table table-stripped table-sm">
		<thead>
			<tr>
				<th>Transportasi</th>
				<th>Type</th>
				<th>Rute</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>

		@foreach($data as $field)

			<tr>
				<td>
					<u>{{ $field->code }}</u><br>
					<small>({{ $field->desc_transportation }})</small>
				</td>
				<td>
					{{ $field->desc_Type }}
				</td>
				<td>
					<u>
						{{ $field->rute_from }}
						<span class="fas fa-aw fa-arrow-alt-circle-right text-primary"></span>
						{{$field->rute_to}}
					</u><br>
					<small>
						Harga : Rp. {{number_format($field->price,0,',','.')}}
						/{{$field->depart_at}} Jam
					</small>
				</td>

				<td class="text-right">
					<a href="{{ route('rute.edit',['id'=>$field->id]) }}" class="btn btn-sm btn-primary">
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
	{{ $data->appends(['cari'=>$cari,'tipe'=>$tipe])->links('vendor.pagination.bootstrap-4') }}

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
				var urlhapus = "{{ route('rute.hapus', ['id'=>':dataid']) }}";
				urlhapus = urlhapus.replace(':dataid',kd_id);
				$('.tombol-send-hapus').attr('href',urlhapus);
			});
		});
	</script>

@endpush