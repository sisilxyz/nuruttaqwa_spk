@extends('layouts.admin')
@section('Title', 'Alternatif')
@section('main-content')
<title>{{ $pagename }}</title>
    <div class="row">          
            <div class="col-md-12">
             <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#listalternatif" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-info">List {{$pagename}}</h6>
                </a>
                <div class="col-12 text-right mt-5">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importExcel"> 
			IMPORT EXCEL
		</button> </div>
 
		<!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="{{ url('/altimport') }}" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="listalternatif">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>NISN</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                    @foreach ($dataalternatif as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            {{$row->nama_alternatif}}
                                        </td>
                                        <td>
                                            {{$row->nisn}}
                                        </td>
                                            <td>
                                            <a href="{{route('alternatif.edit', $row->id)}}" class="btn btn-sm btn-circle btn-warning"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                            </div>
                        </div>
                    </div>
              </div>
        </div>

        <div class="row">     
            <div class="col-md-12">
             <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#rekomjurusan" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-info">List Rekomendasi Jurusan</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="rekomjurusan">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NISN</th>
                                        <th>Nama Siswa</th>
                                        <th>Rekomendasi Jurusan</th>
                                    </tr>
                                </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                    @foreach ($datarekomendasi as $row)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            {{$row->nisn}}
                                        </td>
                                        <td>
                                            {{$row->nama_siswa}}
                                        </td> 
                                        <td>
                                            {{$row->jurusan}}
                                        </td>
                                            </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                            </div>
                        </div>
                    </div>

@stop
@section('js')

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
        
    $('.hapus').on('click', function(){
        swal({
            title: "Apakah anda yakin?",
            text: "Setelah dihapus, Anda tidak dapat mengembalikan data ini!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'DELETE',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success : function()
                    {
                        swal("Data berhasil dihapus!", {
                            icon: "success",
                        }).then((willDelete) => {
                           window.location = "{{route('alternatif.index')}}"
                        });
                    }
                })
                } else {
                        swal("Data kamu aman!");
                    }
                });
                return false;
             })
         })
</script>
@stop