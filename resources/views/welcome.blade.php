<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

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
<body class="antialiased">
    <div class="container">
        <!-- <div class="row"> -->
            <div style="margin-top: 25%">
                <center><h1>Sistem Pendukung Keputusan Rekomendasi Pemilihan Jurusan</h1></center>
                <form id="newdata" action="{{ route('newdata') }}" method="POST" name="newdata" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row" style="margin-top: 50px;">
                        <div class="col-10">
                            <div class="form-group">
                                <!-- <label for="nama">NISN</label> -->
                                <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="nisn" placeholder="Masukkan NISN siswa">

                                <div id="siswa_list">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" id="fsubmit" class="btn btn-primary" style="width: 100%;" disabled>Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        <!-- </div> -->
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        $('#nisn').on('keyup', function() {
            var query = $(this).val();
            $.ajax({
                url: "{{ route('search') }}",
                type: "GET",
                data: {
                    'nisn': query
                },
                success: function(data) {
                    if(data == 'Siswa telah mendapatkan rekomendasi'){
                        $('#siswa_list').html(data);
                        document.getElementById("fsubmit").disabled = true;
                    }else if(data == 'Siswa belum mendapatkan rekomendasi'){
                        $('#siswa_list').html(data);
                        document.getElementById("fsubmit").disabled = false;
                    }else{
                        $('#siswa_list').html('Siswa tidak terdaftar');
                        document.getElementById("fsubmit").disabled = true;
                    }
                }
            })
        });
    });
</script>


</html>