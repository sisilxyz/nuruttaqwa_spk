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

</head>
<body id="page-top">
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="header py-1">
        <h3 class="hm-0 font-weight-bold text-info">{{ __('Sistem Pendukung Keputusan Pemilihan Jurusan Siswa SMK Nurut Taqwa') }}</h3>
    </div>
</nav>
    <form id="newdatapost" action="{{ route('newdatapost') }}" method="POST" name="newdatapost" enctype="multipart/form-data">
    <div class="container">
        <center><h1 style="margin: 20px 0px;">Data Siswa</h1></center>
        <div class="row text-center" style="margin-top: 50px;">
                @csrf
                <div class="col-4 text-left mt-2">NISN</div>
                <div class="col-8 text-left mt-2"><input type="text" value="<?= $a ?>" name="   " style="width: 100%;" disabled></div>
                <input type="hidden" value="<?= $a ?>" name="nisn">
                <div class="col-4 text-left mt-2">Nama Siswa</div>
                <div class="col-8 text-left mt-2" style="margin-bottom: 50px;"><input type="text" value="<?= $data2[0]['nama_alternatif'] ?>" name="nama" placeholder="Masukkan nama siswa" style="width: 100%;" disabled></div>
                <input type="hidden" value="<?= $data2[0]['nama_alternatif'] ?>" name="nama">
              <table class="table">

                <div class="col-12 text-center mt-2 hm-0 font-weight-bold text-danger">Mohon Untuk Mengisi Nilai Mata Pelajaran Sesuai Nilai Raport Terakhir di SMP!</div><br><br>
                    <thead>
                        <tr>
                            @foreach($kriteria as $key => $value)
                                <th style="border: none;"> {{$value->nama_kriteria}} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kriteria as $key => $value)
                        <td style="border: none;">
                            <select name="crips[]" class="form-control">
                                @foreach($value->crips as $key => $v_1)
                                <option value="{{$v_1->id}}">
                                    {{$v_1->nama_crips}}
                                </option>
                                @endforeach
                            </select>
                        </td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
                <div class="col-6 font-weight-bold mb-4">Pertanyaan</div>
                <div class="col-6 font-weight-bold mb-4">Jawaban</div>
                <div class="col-6 text-left mb-2">01. Saya mampu membedakan perangkat komputer berdasarkan fungsinya</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q1" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q1" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q1" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q1" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">02. Saya mampu memahami proses administrasi dengan baik</div>
                <div class="col-6 text-center mb-2"><input name="q2" type="radio" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input name="q2" type="radio" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input name="q2" type="radio" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input name="q2" type="radio" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">03. Saya mampu menemukan perbedaan mendasar tipe-tipe sepeda motor.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q3" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q3" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q3" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q3" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">04. Saya mampu menemukan perbedaan mendasar antara tipe-tipe kendaraan ringan roda 4.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q4" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q4" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q4" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q4" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">05. Saya mampu melakukan perakitan atapun perbaikan pada sebuah komputer</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q5" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q5" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q5" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q5" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">06. Saya merupakan orang yang teliti dalam mengelola keuangan</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q6" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q6" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q6" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q6" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">07. Saya mampu melakukan modifikasi pada sepeda motor.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q7" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q7" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q7" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q7" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">08. Saya mampu melakukan pemeliharaan mesin kendaraan ringan roda 4.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q8" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q8" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q8" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q8" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">09. Saya memiliki ketertarikan mengenai perancangan dan pemrograman jaringan komputer</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q9" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q9" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q9" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q9" style="margin: 0px 2px 0px 15px" value="1" > Sangat setuju</div>
                <div class="col-6 text-left mb-2">10. Saya tertarik mempelajari tentang perhitungan perbankan dan perpajakan</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q10" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q10" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q10" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q10" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">11. Saya memiliki ketertarikan dalam pembuatan desain tampilan sepeda motor</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q11" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q11" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q11" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q11" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">12. Saya tertarik dalam pembuatan desain otomotif kendaraan ringan roda 4</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q12" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q12" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q12" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q12" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">13. Saya memiliki ketertarikan terhadap teknologi digital.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q13" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q13" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q13" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q13" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">14. Saya seseorang yang terorganisir dalam mengelola keuangan</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q14" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q14" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q14" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q14" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">15. Saya memiliki ketertarikan terhadap perakitan ataupun pemeliharaan sepeda motor.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q15" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q15" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q15" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q15" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">16. Saya  memiliki keingintahuan yang besar terhadap perakitan kendaraan ringan roda 4</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q16" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q16" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q16" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q16" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">17. Saya  lebih  cermat  dalam perhitungan.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q17" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q17" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q17" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q17" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">18. Saya suka  merakit atau membenahi suatu barang.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q18" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q18" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q18" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q18" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">19. Saya tertarik pada bidang administrasi.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q19" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q19" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q19" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q19" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-6 text-left mb-2">20. Saya menyukai hal-hal terkait modifikasi barang-barang.</div>
                <div class="col-6 text-center mb-2"><input type="radio" name="q20" style="margin: 0px 2px 0px 15px" value="0.25" >Tidak Setuju<input type="radio" name="q20" style="margin: 0px 2px 0px 15px" value="0.5" >Kurang Setuju<input type="radio" name="q20" style="margin: 0px 2px 0px 15px" value="0.75" >Setuju<input type="radio" name="q20" style="margin: 0px 2px 0px 15px" value="1"> Sangat setuju</div>
                <div class="col-12 mt-3 mb-5">
                    <button class="btn btn-primary">Submit</button>
                </div>          
            </div>
        </div>
    </form>
</body>
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
</html>
