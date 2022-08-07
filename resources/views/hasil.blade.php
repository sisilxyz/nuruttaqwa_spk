<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SPK</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }}">

    <!-- Favicon -->
    <link href="{{ asset('img/smkn.png') }}" rel="icon" type="image/png">
<style>
    @media print {
        .noPrint{
            display:none;
        }
    }

    .tdw-200{
        width: 100px;
    }
    .tdnb{
        border: none;
    }
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <button class="btn btn-danger noPrint" style="width: 150px;" onclick="window.print();"><i class="fas fa-file-pdf">Print</i></button>
            </div>
            <div class="col-12 mt-5">
             <div class="row justify-content-center">
              <div class="col-lg-14 order-lg-2">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Hasil Rekomendasi</h6>
                </div>
                <div class="col-12 mt-5">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>NISN:</td>
                            <td><?= $data['siswa']['nisn'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama:</td>
                            <td><?= $data['siswa']['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Rekomendasi Jurusan 1:</td>
                            
                            <td><b><?= $data['rekomendasi2'][0] ?></b></td>
                        </tr>
                        <tr>
                            <td>Rekomendasi Jurusan 2:</td>
                            <td><b><?= $data['rekomendasi2'][1] ?></b></td>
                        </tr>
                        <tr>
                            <td>Nilai Akhir:</td>
                            <td><?= $data['hasil'] ?> poin</td>
                        </tr>
                        <tr>
                            <td>Nilai pertanyaan:</td>
                            <td>
                                <div class="row">
                                    @foreach ($data['jawaban'] as $key => $value )
                                    <div class="col-4">
                                            <b>{{ $key }}</b> :
                                            @foreach ($value as $key1 => $value1)
                                            {{$value1}},
                                            @endforeach
                                        </div>
                                        @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai rata-rata pertanyaan:</td>
                            <td>
                                <div class="row">
                                    @foreach ($data['r'] as $key => $value )
                                    <div class="col-4">
                                            <b>{{ $key }}</b> :
                                            
                                            {{$value}},
                                            
                                        </div>
                                        @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Nilai matapelajaran: </td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <b>Bahasa Indonesia </b> {{ $nilai[0] }}
                                    </div>
                                    <div class="col-6">
                                        <b>Bahasa Inggris </b> {{ $nilai[1] }}
                                    </div>
                                    <div class="col-6">
                                        <b>IPA </b> {{ $nilai[2] }}
                                    </div>
                                    <div class="col-6">
                                        <b>IPS </b> {{ $nilai[3] }}
                                    </div>
                                    <div class="col-6">
                                        <b>Matematika </b> {{ $nilai[4] }}
                                    </div>
                                    <div class="col-6">
                                        <b>TIK </b> {{ $nilai[5] }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    </div>
        </div>
            <div class="col-12 text-center mt-5">
                <a href="{{ route('landing') }}" class="btn btn-primary noPrint" style="width: 150px;">Kembali</a>
        </div>
    </div>
   
    <br>

<!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('datatable/datatables.min.js')}}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
      $('#datatables').DataTable({
        autoWidth: false,
        columnDefs:[
            {
                targets:['_all'],
                className: 'mdc-data-table__cell'
            }
        ]
      }
      );
    });
  </script>

</body>
</html>
