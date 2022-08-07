@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 font-weight-bold text-info" >{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Siswa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countA}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Rekomendasi</div>
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countR}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kriteria</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$countK}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Users -->
         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1"><a target="_blank" rel="nofollow" href="https://elearning.smknuruttaqwasonggon.sch.id/">Klik Untuk Masuk E-Learning SMK Nurut Taqwa→</a></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

  
        <div class="col-lg-12 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <center><h6 class="m-0 font-weight-bold text-info">SMK Nurut Taqwa</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="{{ asset('img/smk.jpg') }}" alt="">
                    </div>
                    <h4 class="m-0 font-weight-bold text-info">Tentang SMK Nurut Taqwa</h4>
                    <p>SMK Nurut Taqwa merupakan salah satu Lembaga Pendidikan Menengah Kejuruan di Banyuwangi, Jawa Timur yang menerapkan sistem Boarding School yaitu sistem sekolah berasrama.</p>
                    <h4 class="m-0 font-weight-bold text-info">Program Sekolah</h4>
                    <p>Adanya berbagai kegiatan pelatihan dari luar yang sering dilakukan di sekolah ini memudahkan sekolah berhubungan dengan dunia usaha dan dunia industri juga dalam mengadopsi kemajuan teknologi yang saat ini berkembang dengan pesat.</p>
                    <h4 class="m-0 font-weight-bold text-info">Program Sekolah</h4>
                    <p>Program Keahlian yang ada di SMK NURUT TAQWA memiliki 4 Program Kompetensi Keahlian diantaranya:</p>
                    <p>1.Tekhnik Komputer Dan Jaringan</p>
                    <p>2.Teknik Kendaraan Ringan</p>
                    <p>3.Akutansi</p>
                    <p>4.Teknik Bisnis Sepedah Motor</p>
                    <a target="_blank" rel="nofollow" href="https://www.smknuruttaqwasonggon.sch.id/">Klik Untuk Mengunjungi Website SMK Nurut Taqwa →</a>
                </div>
            </div>
        </div>
    </div>
@endsection
