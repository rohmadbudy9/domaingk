<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="csrf-token" content="<?= csrf_hash(); ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <title>Form Visit Data Center GK</title>
    <!-- CSS files -->
    <link href="https://apps.ndcmoratelindo.com/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="https://apps.ndcmoratelindo.com/dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="https://apps.ndcmoratelindo.com/dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="https://apps.ndcmoratelindo.com/dist/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="https://apps.ndcmoratelindo.com/dist/css/demo.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/datatables-select/css/select.bootstrap4.min.css">
    <link rel="stylesheet"
        href="https://apps.ndcmoratelindo.com/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/icons/iconfont/tabler-icons.css">
    <link rel="stylesheet"
        href="https://apps.ndcmoratelindo.com/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css">
    <link rel="stylesheet" href="https://apps.ndcmoratelindo.com/assets/plugins/daterangepicker/daterangepicker.css">

    <link rel="shortcut icon" href="#">
    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
    <style>
        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url(assets/clients/loading2.gif) no-repeat center center;
            z-index: 10000;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .tip-hover {
            position: relative;
        }

        .tip-hover .tip-text {
            visibility: hidden;
            width: fit-content;
            background-color: #f9f9f9;
            color: #307fdd;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            left: 100%;
            margin-left: -220px;
            opacity: 1;
            top: 100%;
            transition: opacity 0.3s;
        }

        .tip-hover:hover .tip-text {
            visibility: visible;
            opacity: 1;
        }

        .svg-icon {
            position: relative;
            flex-shrink: 0;
        }

        .container {
            display: inline-block;
            width: 320px;
        }

        #Cam {
            background: rgb(255, 255, 215);
        }

        #Prev {
            background: rgb(255, 255, 155);
        }

        #Saved {
            background: rgb(255, 255, 55);
        }

        /* end of test camera style */

        html {
            background: url('bg_auth.png') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            background-color: #E3F2F7;
        }

        .rows {
            height: 100hv;
        }

        table.dataTable table {
            border-radius: 5px;
        }

        table.dataTable thead tr th {
            background-color: #206bc4;
            color: #fff;
        }

        @media (min-width:320px) {
            /* body {
            margin: 0;
            height: 100%;
            min-width: 100%;
            background-color: #E3F2F7;
            background: url('https://apps.ndcmoratelindo.com/assets/illustrations/backgrounds.svg') repeat;
            background-size: cover;
        } */

            /* body {
            margin: 0;
            height: 100%;
            background-image: linear-gradient(to bottom right, #F4FAFC, #307fdd);
        } */

            .rows {
                height: 100vh;
            }

            .cards .card {
                margin-bottom: 10px;
            }

            .cards2 .card {
                margin-bottom: 10px;
            }

            .cards3 .card {
                margin-bottom: 10px;
            }

            .cards3 .toms {
                margin-top: 5px;
            }

            .cards4 .card {
                display: none;
                margin-bottom: 10px;
            }

            .partner {
                margin-left: 30%;
                margin-right: 30%;
            }

            .clients {
                margin-left: 20%;
                margin-right: 20%;
            }

            .gbr {
                position: absolute;
                width: 300px;
                height: 300px;
                top: 630px;
                left: 100px;
            }

            .rows .rows1 {
                position: relative;
            }

            .front-text {
                margin-top: 100px;
            }

            .vertical-center {
                position: absolute;
            }

            .testnav2 {
                display: none;
            }

            .lastnav {
                display: none;
            }

            .advice-title {
                display: none;
            }

            .footer-profile {
                display: none;
            }

            .view-partners {
                display: none;
            }

            .price::before {
                font-size: 30px;
                top: -80px;
                left: 0;
                position: relative;
                content: 'IDR';
                font-weight: lighter;
            }

            .price strong {
                font-size: 135px;
                font-weight: 600;
            }

            .price span {
                font-size: 31px;
                top: -75px;
                position: relative;
            }

            .price em {
                position: relative;
                left: -80px;
                font-size: 20px;
                font-weight: lighter;
            }

            .progress-bar-danger {
                background-color: #e90f10;
            }

            .progress-bar-warning {
                background-color: #ffad00;
            }

            .progress-bar-success {
                background-color: #02b502;
            }

            .btn-add a {
                width: 100%;
                border-radius: 0;
            }

        }

        @media (min-width:800px) {
            /* body {
            margin: 0;
            min-height: 100%;
            min-width: 100%;
            background-color: #E3F2F7;
            background: url('https://apps.ndcmoratelindo.com/assets/illustrations/backgrounds.svg') no-repeat;
            background-size: cover;
        } */

            .rows {
                height: 100vh;
            }

            .cards .card {
                margin-bottom: 10px;
            }

            .cards2 .card {
                margin-bottom: 10px;
            }

            .cards3 .card {
                margin-bottom: 10px;
            }

            .cards3 .toms {
                margin-top: 5px;
            }

            .cards4 .card {
                display: none;
                margin-bottom: 10px;
            }

            .partner {
                margin-left: 40%;
                margin-right: 40%;
            }

            .clients {
                margin-left: 30%;
                margin-right: 30%;
            }

            .rows .rows1 {
                position: relative;
                margin-bottom: 20px;
            }

            .rows .rows2 {
                position: relative;
                margin-top: 20px;
            }

            .gbr {
                position: absolute;
                width: 300px;
                height: 300px;
                top: 630px;
                left: 100px;
            }

            .front-text {
                margin-top: 100px;
            }

            .vertical-center {
                position: absolute;
            }

            .testnav2 {
                display: none;
            }

            .advice-title {
                display: none;
            }

            .footer-profile {
                display: none;
            }

            .view-partners {
                display: none;
            }

            .price::before {
                font-size: 30px;
                top: -80px;
                left: 0;
                position: relative;
                content: 'IDR';
                font-weight: lighter;
            }

            .price strong {
                font-size: 135px;
                font-weight: 600;
            }

            .price span {
                font-size: 31px;
                top: -75px;
                position: relative;
            }

            .price em {
                position: relative;
                left: -80px;
                font-size: 20px;
                font-weight: lighter;
            }

            .progress-bar-danger {
                background-color: #e90f10;
            }

            .progress-bar-warning {
                background-color: #ffad00;
            }

            .progress-bar-success {
                background-color: #02b502;
            }

            .btn-add a {
                width: 100%;
                border-radius: 0;
            }

            .open_photo {
                width: 400px;
            }


        }

        @media (min-width:1025px) {
            body {
                margin: 0;
                min-height: 100%;
                min-width: 100%;
                background: inherit;
            }

            .cards {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-auto-rows: auto;
                grid-gap: 1rem;
            }

            .cards2 {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                grid-auto-rows: auto;
                grid-gap: 1rem;
            }

            .cards3 {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: auto;
                grid-gap: 1rem;
            }

            .cards3 .toms {
                margin-top: 0;
            }

            .cards4 {
                display: grid;
                grid-template-columns: repeat(6, 1fr);
                grid-auto-rows: auto;
                grid-gap: 1rem;
            }

            .cards5 {
                margin-left: 43%;
                display: grid;
                grid-template-columns: repeat(5, 5%);
            }

            .cards4 .card {
                display: block;
                margin-bottom: 10px;
            }

            .center {
                text-align: center;
                border: 3px solid green;
            }

            .partner {
                margin-left: 10%;
                margin-right: 10%;
            }

            .clients {
                margin-left: 10%;
                margin-right: 10%;
            }

            .judul {
                position: absolute;
            }

            .test {
                display: none;
            }

            .gbr {
                position: absolute;
                left: 550px;
                top: 80px;
                width: 600px;
                height: 600px;
            }

            .front-text {
                width: 600px;
            }

            .front-text2 {
                width: 560px;
            }

            .testnav2 {
                display: block;
            }

            .testnav {
                display: none;
            }

            .lastnav {
                display: block;
            }

            .columnA {
                float: left;
                width: 40%;
            }

            .columnB {
                float: right;
                width: 60%;
            }

            .columnC {
                float: left;
                width: 50%;
            }

            .columnD {
                float: right;
                width: 50%;
            }

            .columnE {
                float: left;
                width: 20%;
            }

            .columnF {
                float: right;
                width: 80%;
            }

            .columnG {
                float: left;
                width: 30%;
            }

            .columnH {
                float: right;
                width: 70%;
            }

            .columnI {
                float: left;
                width: 80%;
            }

            .columnJ {
                float: right;
                width: 20%;
            }

            .btn-ask {
                width: 45%;
                margin: 20px;
            }

            .advice-title {
                display: block;
            }

            .advice-title2 {
                display: none;
            }

            .footer-profile {
                display: block;
                text-align: center;
            }

            .rows1 {
                background-color: #e8f4f8;
                background: url('https://apps.ndcmoratelindo.com/assets/illustrations/back-domain.svg');
                background-repeat: no-repeat;
                background-size: 2000px 900px;
                width: auto;
            }

            .view-partners {
                display: block;
            }

            .price::before {
                font-size: 30px;
                top: -80px;
                left: 0;
                position: relative;
                content: 'IDR';
                font-weight: lighter;
            }

            .price strong {
                font-size: 135px;
                font-weight: 600;
            }

            .price span {
                font-size: 31px;
                top: -75px;
                position: relative;
            }

            .price em {
                position: relative;
                left: -80px;
                font-size: 20px;
                font-weight: lighter;
            }

            .progress-bar-danger {
                background-color: #e90f10;
            }

            .progress-bar-warning {
                background-color: #ffad00;
            }

            .progress-bar-success {
                background-color: #02b502;
            }

            .line {
                position: absolute;
                top: 180px;
                height: 1px;
                width: 100%;
                background-color: #206bc4;
            }

            .sub-line {
                position: relative;
                height: 1px;
                width: 100%;
                background-color: #206bc4;
            }

            .btn-add {
                position: absolute;
                top: 155px;
                right: 20px;
            }

            .btn-add a {
                border-radius: 50%;
                width: 50px;
                height: 50px;
            }

            .open_photo {
                width: 400px;
            }

        }
    </style>
</head>

<body>
    <div class="page page-center">
        <div class="container-sm" style="padding:35px;">
            <input type="hidden" id="outputs" value="id">
            <br><br>
            <form id="form-survey-id" method="post" autocomplete="off" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h1 class="card-title" style="font-size:16px;font-weight:bold;">
                                Selamat Datang di Data Center Pemkab Gunungkidul!
                            </h1>
                            <p class="card-subtitle">
                                Mohon mengisi formulir di bawah ini jika anda ingin melanjutkan pengalaman berkunjung
                                anda. Kolom dengan tanda (<span style="color:red">*</span>) wajib diisi.
                            </p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Ruang Data Center<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <select class="form-control select" id="dc_location" name="dc_location"
                                    style="width:100%;" required>
                                    <option value="Network Data Center Pemkab Gunungkidul">Network Data Center Pemkab Gunungkidul</option>
                                    <option value="Server Data Center Pemkab Gunungkidul">Server Data Center Pemkab Gunungkidul</option>
                                </select>
                            </div>
                        </div>
                        <div id="kategori">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Kategori<span
                                        style="color:red">*</span></label>
                                <div class="col">
                                    <select class="form-control select" id="kategori" name="kategori"
                                        style="width:100%;" required>
                                        <option hidden>-- PILIH REFERENSI --</option>
                                        <option value="Others">Non Data Center</option>
                                        <option value="Data Center">Data Center</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Keperluan<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <div id="keperluan">

                                    <input type="radio" id="survey" name="keperluan" value="Survey">
                                    <label for="survey">Survey</label>


                                    <input type="radio" id="meeting" name="keperluan" value="Meeting">
                                    <label for="meeting">Meeting</label>


                                    <input type="radio" id="interview" name="keperluan" value="Interview">
                                    <label for="interview">Interview</label>

                                    <input type="radio" id="others_ndc" name="keperluan" value="NDC Team Others">
                                    <label for="Others">Others</label>

                                </div>
                            </div>
                        </div>

                        <div id="needs_dcteam">
                            <div class="form-group mb-3 row">
                                <label class="form-label col-3 col-form-label">Bertemu Dengan<span
                                        style="color:red">*</span></label>
                                <div class="col">
                                    <select class="form-control select" id="needs_dcteam" name="needs_dcteam"
                                        style="width:100%;" required>
                                        <option hidden>-- PILIH PIC --</option>
                                        <option value="KUSJAYANTO SAPUTRO, SH.M.M">KUSJAYANTO SAPUTRO, SH.M.M</option>
                                        <option value="YUYUN RETNA PRAMUJI, SH">YUYUN RETNA PRAMUJI, SH</option>
                                        <option value="MOCHAMAD SOLEH, S.Kom.">MOCHAMAD SOLEH, S.Kom.</option>
                                        <option value="WAHYU KURNIAWAN A.Md.">WAHYU KURNIAWAN A.Md.</option>
                                        <option value="MUHAMMAD YUSUF NUR PRABOWO A.Md.">MUHAMMAD YUSUF NUR PRABOWO A.Md.</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nama Tamu<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Isi dengan nama lengkap tamu"
                                    id="guest_name" name="guest_name" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Asal Tamu<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Isi dengan asal tamu"
                                    id="guest_origin" name="guest_origin" required>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nomor Telepon/HP<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <input type="text" class="form-control"
                                    placeholder="Isi dengan nomor telepon/HP (Aktif)" id="guest_phone"
                                    name="guest_phone" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Email<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <input type="email" class="form-control" placeholder="Isi dengan alamat email (Active)"
                                    id="guest_email" name="guest_email" required>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Jumlah Personel<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <input type="number" min="0" class="form-control" placeholder="Total personel"
                                    id="guest_personel" name="guest_personel" style="width:30%;" required>

                                <br>
                                <table id="verse" class="table" border="0">
                                    <thead>
                                        <tr id='noa_header' style="display:none">
                                            <th style="text-align:center:">Nomor</th>
                                            <th style="text-align:center:">Nama Personel</th>
                                            <th style="text-align:center:">Nomor HP Personel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Aktivitas<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <textarea class="form-control"
                                    placeholder="Isi dengan detail aktivitas yang akan dilakukan" id="guest_activity"
                                    name="guest_activity" rows="5" required></textarea>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Foto Diri<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <div id="open-webcam3">
                                    <div class="card" style="height:fit-content;width:fit-content;">
                                        <div class="card-status-top bg-primary"></div>
                                        <div class="card-header">
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal-success3" onClick="ShowCam3()">Ambil Gambar</button>
                                        </div>
                                        <div class="card-body p-0" style="padding:5px;">
                                            <div class="open_photo_personal"
                                                style="height:300px;overflow-y:scroll;overflow-x:scroll;">
                                                <div id="photo-personal">
                                                    <img id="right-personal"
                                                        src="https://apps.ndcmoratelindo.com/assets/photos/selfie_personal.png"
                                                        alt="selfie photo" style="height:400px;" /><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Kartu ID Personal/KTP/Paspor<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <div id="open-webcam4">
                                    <div class="card" style="height:fit-content;width:fit-content;">
                                        <div class="card-status-top bg-primary"></div>
                                        <div class="card-header">
                                            <button class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modal-success4" onClick="ShowCam4()">Ambil Gambar</button>
                                        </div>
                                        <div class="card-body p-0" style="padding:5px;">
                                            <div class="open_photo_ktp"
                                                style="height:300px;overflow-y:scroll;overflow-x:scroll;">
                                                <div id="photo-ktp">
                                                    <img id="right-ktp" src="https://apps.ndcmoratelindo.com/assets/photos/selfie_id_new.png"
                                                        alt="selfie photo" style="height:400px;" /><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Tanggal Kedatangan<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <div class="input-icon col-4" style="float:left;">
                                    <input class="form-control " placeholder="Pilih Tanggal" id="datepicker-icon"
                                        name="login_date" required />
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                                <div class="input-icon" style="float:left;margin-left:10px;margin-right:10px;">
                                    <span>&nbsp-&nbsp</span>
                                </div>
                                <div class="input-icon col-4" style="float:left;">
                                    <input class="form-control " name="login_date_out" placeholder="Pilih Tanggal"
                                        id="datepicker-icon-out" required />
                                    <span class="input-icon-addon">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                                <br>
                                <span style="color:red;font-size:11px;float:left;">Tanggal kunjungan hanya tersedia dari hari Senin s/d Jumat</span>
                            </div>

                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Waktu Kedatangan<span
                                    style="color:red">*</span></label>
                            <div class="col">
                                <div class="input-group mb-2 date" id="timepicker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" name="timepicker"
                                        data-target="#timepicker" data-toggle="datetimepicker" placeholder="(GMT -07:00) Asia/Jakarta" required />
                                    <span class="input-icon-addon">
                                        <i class="ti ti-clock"></i>
                                    </span>
                                </div>
                                <span style="color:red;font-size:11px;">Waktu kunjungan hanya tersedia selama jam kerja (08.00 - 15.00 WIB)</span>
                            </div>
                        </div>
                    </div>
                    <script language="JavaScript">
                        function open_snapshot3() {
                            $('#camera_desktop3').show();
                            $('#result_desktop3').hide();
                        }

                        function open_snapshot4() {
                            $('#camera_desktop4').show();
                            $('#result_desktop4').hide();
                        }

                        function take_snapshot3() {
                            Webcam.snap(function(data_uri) {
                                $('#camera_desktop3').hide();
                                $('#result_desktop3').show();
                                document.getElementById('results3').innerHTML =
                                    '<img id="base64image3" style="width:100%" src="' +
                                    data_uri +
                                    '"/>';
                                // <button onclick="SaveSnap();">Save Snap</button>
                            });
                        }

                        function take_snapshot4() {
                            Webcam.snap(function(data_uri) {
                                $('#camera_desktop4').hide();
                                $('#result_desktop4').show();
                                document.getElementById('results4').innerHTML =
                                    '<img id="base64image4" style="width:100%" src="' +
                                    data_uri +
                                    '"/>';
                                // <button onclick="SaveSnap();">Save Snap</button>
                            });
                        }

                        function SaveSnap3() {
                            //last id for files
                            let last_id = ["10081"];
                            let int_last_id = parseInt(last_id);
                            let max_id = (int_last_id + 1);
                            let str_last_id = max_id.toString();
                            //current date for files
                            let current_date = 2025120396308986;
                            let str_current = current_date.toString();
                            let unique = str_current + Date.now().toString(36) + Math.random().toString(16).slice(2);

                            //filename 
                            let filenames = unique.concat("_", str_last_id.concat("_", "photo.jpg"));

                            let form = document.getElementById("form-survey-id");
                            let files = document.getElementById("base64image3").src;
                            let block = files.split(";");
                            let contentType = block[0].split(":")[1];
                            let realData = block[1].split(",")[1];

                            let blob = b64toBlob(realData, contentType);

                            document.getElementById('photo-personal').innerHTML =
                                '<input type="file" id="input_photo" name="input_photo" hidden><img id="right-personal" src="' +
                                files +
                                '"/>';

                            let container = new DataTransfer();

                            let file = new File([blob], filenames, {
                                type: "image/jpeg",
                                lastModified: new Date().getTime()
                            });
                            container.items.add(file);

                            let fileInputElement = document.getElementById('input_photo');
                            fileInputElement.files = container.files;

                            $('#modal-success3').modal('hide');
                        }

                        function SaveSnap4() {
                            //last id for files
                            let last_id = ["10081"];
                            let int_last_id = parseInt(last_id);
                            let max_id = (int_last_id + 1);
                            let str_last_id = max_id.toString();
                            //current date for files
                            let current_date = 202512031419319544;
                            let str_current = current_date.toString();
                            let unique = str_current + Date.now().toString(36) + Math.random().toString(16).slice(2);

                            //filename 
                            let filenames = unique.concat("_", str_last_id.concat("_", "ktp.jpg"));

                            let form = document.getElementById("form-survey-id");
                            let files = document.getElementById("base64image4").src;
                            let block = files.split(";");
                            let contentType = block[0].split(":")[1];
                            let realData = block[1].split(",")[1];

                            let blob = b64toBlob(realData, contentType);

                            document.getElementById('photo-ktp').innerHTML =
                                '<input type="file" id="input_ktp" name="input_ktp" hidden><img id="right-ktp" src="' +
                                files +
                                '"/>';

                            let container = new DataTransfer();

                            let file = new File([blob], filenames, {
                                type: "image/jpeg",
                                lastModified: new Date().getTime()
                            });
                            container.items.add(file);

                            let fileInputElement = document.getElementById('input_ktp');
                            fileInputElement.files = container.files;

                            $('#modal-success4').modal('hide');
                        }

                        function ShowCam3() {
                            Webcam.reset();
                            Webcam.set({
                                width: 220,
                                height: 330,
                                image_format: 'jpeg',
                                jpeg_quality: 100,
                                constraints: {
                                    width: 220, // { exact: 320 },
                                    height: 320, // { exact: 180 },
                                    facingMode: 'user',
                                    frameRate: 30
                                }
                            });
                            Webcam.attach('#my_camera3');
                        }

                        function ShowCam4() {
                            Webcam.reset();
                            Webcam.set({
                                width: 330,
                                height: 190,
                                image_format: 'jpeg',
                                jpeg_quality: 100,
                                constraints: {
                                    width: 320, // { exact: 320 },
                                    height: 180, // { exact: 180 },
                                    facingMode: 'environment',
                                    frameRate: 30
                                }
                            });
                            Webcam.attach('#my_camera4');
                        }
                    </script>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-outline-info" style="width:45%;">Kirim</button>
                        <button type="reset" class="btn btn-outline-danger" style="width:45%;">Atur Ulang</button>
                    </div>
                </div>
            </form>
            <div class="modal modal-blur fade" id="modal-success3" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-primary"></div>
                        <div class="modal-body text-center py-4">
                            <br>
                            <div id="camera_desktop3">
                                <div id="my_camera3"></div>
                                <form>
                                    <input type="button" class="btn btn-info" style="border-radius:0;width:320px;"
                                        value="Ambil Gambar" onclick="take_snapshot3()">
                                </form>
                            </div>
                            <div id="result_desktop3">
                                <div id="results3"></div>
                                <button type="button" class="btn btn-primary" style="border-radius:0;width:100%;"
                                    disabled>Hasil Gambar</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><a class="btn btn-info w-100" onclick="SaveSnap3()">
                                            Gunakan Gambar
                                        </a></div>
                                    <div class="col">
                                        <button class="btn btn-primary w-100" onclick="open_snapshot3()">
                                            Ambil Ulang Gambar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal modal-blur fade" id="modal-success4" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-status bg-primary"></div>
                        <div class="modal-body text-center py-4">
                            <br>
                            <div id="camera_desktop4">
                                <div id="my_camera4"></div>
                                <form>
                                    <input type="button" class="btn btn-info" style="border-radius:0;width:320px;"
                                        value="Ambil Gambar" onclick="take_snapshot4()">
                                </form>
                            </div>
                            <div id="result_desktop4">
                                <div id="results4"></div>
                                <button type="button" class="btn btn-primary" style="border-radius:0;width:100%;"
                                    disabled>Hasil Gambar</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col"><a class="btn btn-info w-100" onclick="SaveSnap4()">
                                            Gunakan Gambar
                                        </a></div>
                                    <div class="col">
                                        <button class="btn btn-primary w-100" onclick="open_snapshot4()">
                                            Ambil Ulang Gambar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="loader"></div>

    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="https://apps.ndcmoratelindo.com/assets/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://apps.ndcmoratelindo.com/assets/plugins/moment/moment.min.js"></script>
    <script src="https://apps.ndcmoratelindo.com/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js"></script>
    <script src="https://apps.ndcmoratelindo.com/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="https://apps.ndcmoratelindo.com/dist/js/demo.min.js" defer></script>
    <script src="https://apps.ndcmoratelindo.com/dist/js/tabler.min.js" defer></script>
    <script src="https://apps.ndcmoratelindo.com/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="https://apps.ndcmoratelindo.com/dist/libs/litepicker/dist/litepicker.js" defer></script>
    <script type="text/javascript" src="https://apps.ndcmoratelindo.com/assets/plugins/webcam.js"></script>

</body>

</html>