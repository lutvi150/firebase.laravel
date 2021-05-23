<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Firebase</title>
</head>

<body>
    <div class="container">

        <div class="col-md-12">
        </div>
        <div class="col-md-12">
            <button type="button" class="btn btn-success tambah"><i class="fa fa-plus"></i> Tambah User</button>
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Budi</td>
                        <td>budi@gamil.com</td>
                        <td>Padang</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
{{-- modal untuk menambah user --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>

            </div>
            <div class="modal-body">
                <input type="text" hidden id="type">
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted e-nama"></small>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder=""
                        aria-describedby="helpId">
                    <small id="helpId" class="text-muted e-email"></small>
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="3"></textarea>
                    <small id="helpId" class="text-muted e-alamat"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-data">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- Insert these scripts at the bottom of the HTML, but before you use any Firebase services -->

<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-app.js"></script>

<!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-analytics.js"></script>

<!-- Add Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-firestore.js"></script>

<script>
     // digunakan untuk inisiasi firebase
     var firebaseConfig = {
        apiKey: "{{ config('services.firebase.api_key') }}",
        authDomain: "{{ config('services.firebase.auth_domain') }}",
        databaseURL: "{{ config('services.firebase.database_url') }}",
        projectId: "PROJECT_ID",
        storageBucket: "{{ config('services.firebase.storage_bucket') }}",
        messagingSenderId: "SENDER_ID",
        appId: "APP_ID",
        measurementId: "G-MEASUREMENT_ID",
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    // var database=firebase.database();
    // menampilkan data
    var Index=0;
    firebase.database
    // untuk menampilkan modal tambah
    $('.tambah').click(function (e) {
        $('#type').val('simpan');
        $('#modalTambah').modal('show');
    });
    // untuk save data ke firebase
    $(".save-data").click(function (e) {
        e.preventDefault();
        $('.text-muted').text('');
        // ambil value imput
        let email = $('#email').val();
        let nama = $('#nama').val();
        let alamat = $('#alamat').val();
        let idData=Index+1;
        if (email == "") {
            $('.e-email').text('Email Tidak Boleh Kosong')
        }
        if (nama == "") {
            $('.e-nama').text('Nama Tidak Boleh Kosong');
        }
        if (alamat == "") {
            $('.e-alamat').text('Alamat Tidak Boleh Kosong')
        }
        if (alamat !== "" && nama !== "" && email !== "") {
            firebase.database().ref('users/'+idData).set({
                email:email,nama:nama,alamat:alamat
            })
            Index=idData;
        }

    });

</script>

</html>
