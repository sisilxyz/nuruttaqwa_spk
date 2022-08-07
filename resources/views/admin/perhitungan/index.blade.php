@extends('layouts.admin')
@section('Title', 'Perhitungan SAW')
@section('main-content')
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#listkriteria" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Tahap Analisa</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="listkriteria">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Nama Alternatif </th>
                            @foreach($kriteria as $key => $value)
                                <th> {{$value->nama_kriteria}} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alternatif as $alt => $valt)
                        <tr>
                            <td> {{ $valt->nama_alternatif}} </td>
                            @if(count($valt->penilaian) > 0)
                                @foreach($valt->penilaian as $key => $value)
                                    <td>
                                        {{ $value->crips->bobot }}
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td>Tidak Ada Data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#normalisasi" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Tahap Normalisasi</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="normalisasi">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Alternatif / Kriteria </th>
                            @foreach($kriteria as $key => $value)
                                <th> {{$value->nama_kriteria}} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($normalisasi as $key => $value)
                        <tr>
                            <td> {{ $key }} </td>
                            @foreach($value as $key_1 => $value_1)
                            <td>
                            @if($value[count($value)-1] != $key_1)
                            {{ $value_1 }}
                            @endif
                            </td>
                            @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#rank" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Tahap Perangkingan</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="rank">
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            @foreach($kriteria as $key => $value)
                                <th> {{$value->nama_kriteria}} </th>
                            @endforeach
                                <th rowspan="2" style="text-align:center; padding-bottom:45px;"> Total </th>
                                <th rowspan="2" style="text-align:center; padding-bottom:45px;"> Rank </th>
                            </tr>
                        <tr>
                            <th> Bobot </th>
                            @foreach($kriteria as $key => $value)
                                <th> {{$value->bobot}} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1;@endphp
                        @foreach($ranking as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            @foreach($value as $key_1 => $value_1)
                            <td>{{ number_format($value_1, 1) }}</td>
                            @endforeach
                            <td>{{ $no++ }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#rank" class="d-block card-header py-3" data-toggle="collapse"
        role="button" aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary">Rekomendasi Jurusan</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="rank">
        <div class="card-body">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        @php $no = 1;@endphp
                        @foreach($sortNilai as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            @foreach($value as $key_1 => $value_1)
                            <td>{{ $value_1 }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop