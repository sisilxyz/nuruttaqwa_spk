@extends('layouts.admin')
@section('Title', 'Edit', '$kriteria->nama_kriteria')
@section('main-content')
    <div class="row">
        <div class="col-md-4">
             <div class="card shadow mb-4">
                    <!-- Card Header - Accordion -->
                    <a href="#editkriteria" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h6 class="m-0 font-weight-bold text-info">Edit {{$pagename}} {{$kriteria->nama_kriteria}}</h6>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="tambahkriteria">
                        <div class="card-body">
                            @if(Session::has('msg'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <strong>{{Session::get('msg')}}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{route('kriteria.update', $kriteria->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="nama">Nama Kriteria</label>
                                    <input type="text" class="form-control @error ('nama_kriteria') is-invalid @enderror" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}">
                                    @error ('nama_kriteria')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label for="attribut">Atribut Kriteria</label>
                                    <select name="attribut" id="" class="form-control" required >
                                        <option {{ $kriteria->attribut == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                                        <option {{ $kriteria->attribut == 'Cost' ? 'selected' : '' }}>Cost</option>
                                    </select>
                                    @error ('attribut')
                                        <div class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bobot">Bobot Kriteria</label>
                                    <input type="text" class="form-control @error ('bobot') is-invalid @enderror" name="bobot" value="{{ $kriteria->bobot }}">
                                    @error ('bobot')
                                    <div class="invalid-feedback" role="alert">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                               <button type="submit" class="btn btn-info">Simpan</button>
                               <a href="{{route('kriteria.index')}}" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @stop