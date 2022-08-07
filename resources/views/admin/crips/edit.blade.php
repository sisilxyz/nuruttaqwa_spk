@extends('layouts.admin')
@section('Title', $crips->nama_crips)
@section('main-content')
<title> Crips </title>
    <div class="row">
        <div class="col-md-4">
             <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#tambahcrips" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-info">Tambah Crips</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="tambahcrips">
                        <div class="card-body">
                            @if(Session::has('msg'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{Session::get('msg')}}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{route('crips.update', $crips->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                 <div class="form-group">
                                    <label for="nama">Nama Crips</label>
                                    <input type="text" class="form-control @error ('nama_crips') is-invalid @enderror" name="nama_crips" value="{{ $crips->nama_crips }}">
                                    
                                    @error ('nama_crips')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="bobot">Bobot Crips</label>
                                    <input type="text" class="form-control @error ('bobot') is-invalid @enderror" name="bobot" value="{{ $crips->bobot }}">
                                    
                                    @error ('bobot')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                               <button type="submit" class="btn btn-info">Simpan</button>
                               <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@stop
