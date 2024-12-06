<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Print Surat Permohonan Perpindahan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            height: 842px;
            width: 555px;
            margin-left: auto;
            margin-right: auto;
        }
        .header img {
            width: 75px;
            display: inline;
            float: left;
        }
        .header {
            text-align: center;
            margin-top: 10px;
        }
        .textheader {
            display: inline;
            margin-top: 100px;
            text-align: center;
        }
        .headerAddress {
            display: inline-block;
            margin-bottom: 0px;
            margin-top: 0px;
            text-align: left;
        }
        .headingTitle {
            display: inline;
        }
        .title {
            text-align: center;
        }
        .legalitor {
            float: right;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            position: relative;
        }
        
        /* Tambahan style untuk tabel */
        table {
            width: 100%;
            margin-bottom: 1rem;
        }
        
        td {
            padding: 8px;
            vertical-align: top;
        }
        
        /* Style untuk print */
        @media print {
            .btn-print {
                display: none;
            }
            body {
                margin: 0;
                padding: 20px;
            }
        }
    </style>
    
    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        function prints() {
            document.getElementById('btnPrint').style.display = "none";
            window.print();
            window.onafterprint = show();
        }
        function back() {
            window.location = 'report';
        }
        function show() {
            document.getElementById('btnBack').style.display = "inline";
            document.getElementById('btnPrint').style.display = "inline";
        }
    </script>
</head>

<body class="container">
    <!-- Ganti button dengan class Bootstrap -->
    <button id="btnPrint" onclick="prints()" class="btn btn-success btn-print mb-3">
        <i class="bi bi-printer"></i> Print
    </button>

    <div class="header" style="position: relative; display: flex; align-items: center; justify-content: space-between; page-break-before: always !important;">
        <div style="display: flex; align-items: center; margin-right: 30px !important;">
            <div style="display: flex; align-items: center;">
                <!-- Gambar dari URL -->
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/40/Seal_of_the_Ministry_of_Internal_Affairs_of_the_Republic_of_Indonesia_%282020_version%29.svg" 
                     alt="Logo Kemendagri" 
                     style="width: 80px; height: auto; margin-right: 10px;" />
                
                <!-- Gambar dari lokal -->
                <img src="{{ asset('images/KEMENDAGRI.png') }}" 
                     alt="Text Kemendagri" 
                     style="height: 40px; width: auto; margin-left: 10px;" />
                
            </div>
              
        </div>
        <div style="text-align: left;">
            <h4 class="textheader" style="margin: 0; font-size: 16px;">KEMENTERIAN DALAM NEGERI</h4><br>
            <h4 class="textheader" style="margin: 0; font-size: 16px;">REPUBLIK INDONESIA</h4><br>
            <h4 class="textheader" style="margin: 0; font-size: 16px;">KOTA PALEMBANG</h4><br>
        </div>
    </div>
    <span style="border: solid 0.5px; width: 100%; display: block; margin-top: 10px;"></span>
    <span style="border: solid 1.5px; width: 100%; display: block; margin-top: 2px;"></span>
    <div class="headerAddress" style="text-align: center; margin-top: 5px; font-size: 9px;">
        Jalan Medan Merdeka Utara No. 7 Jakarta Pusat 10110 DKI Jakarta, Indonesia
        Telepon : (021) 3521535.
        <br>website: ditjenbinaadwil@kemendagri.go.id. email: info@kemendagri.go.id
    </div>
    <div class="title" style="text-align: center; margin-top: 20px;">
        <i>
            <h4 style="display: inline; font-weight bold;">بسم اللّه الرحمٰن الرحيم</h4>
        </i>
        <br><br>
    </div>

    <div class="title">
        <u>
            <h4 class="headingTitle">SURAT PERMOHONAN PERPINDAHAN</h4>
        </u><br>
        <h4 class="headingTitle">Nomor : {{ $permohonan->nomor_surat }}</h4>
    </div>
    <br>
    <p align="justify">
        Dengan rahmat Allah SWT, sesuai peraturan Akademik Universitas Muslim Indonesia dan Surat Ketua Program Studi
        Teknik Informatika nomor :
        310/H.22/TI/FIK-UMI/IV/2023, tertanggal
        20 November 2024, maka dengan ini menetapkan Panitia Ujian Tugas Akhir sebagai
        berikut
    </p>
    <div>
        <table>
            <tr>
                <td width="150px">Pembimbing Utama</td>
                <td>:</td>
                <td>Ramdan Satra, S.Kom., M.Kom., MTA</td>
            </tr>
            <tr>
                <td>Pembimbing Pendamping</td>
                <td>:</td>
                <td>Ir. Syahrul Mubarak Abdullah, S.Kom. M.Kom., MTA</td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table>
            <tr>
                <td width="150px">Ketua Sidang</td>
                <td>:</td>
                <td>Tasrif Hasanuddin, S.T., M.Cs</td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table>
            <tr>
                <td width="150px">Penguji</td>
                <td>:</td>
                <td>1. Ir. Yulita Salim, S.Kom.,M.T., MTA</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>2. Andi Widya Mufila Gaffar, S.T., M.Kom</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>3. Muhammad Arfah Asis, S.Kom., M.T</td>
            </tr>
        </table>
    </div>
    <br>
    <p align="justify">
        Untuk melaksanakan Ujian Tugas Akhir bagi mahasiswa :
    </p>
    <div>
        <table>
            <tr>
                <td width="150px">Nama / Stambuk</td>
                <td>:</td>
                <td>{{ $permohonan->user->name }} / {{ $permohonan->user->stambuk }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <td width="150px">Judul Tugas Akhir</td>
                <td>:</td>
                <td>{{ $permohonan->judul_tugas_akhir }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <td width="150px">Hari/Tanggal</td>
                <td>:</td>
                <td>{{ $permohonan->hari }}, {{ \Carbon\Carbon::parse($permohonan->tanggal)->format('d F Y') }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <td width="150px">Waktu</td>
                <td>:</td>
                <td>{{ $permohonan->waktu }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <td width="150px">Tempat</td>
                <td>:</td>
                <td>{{ $permohonan->tempat }}</td>
            </tr>
        </table>
    </div>
    <p align="justify">
        Demikian surat penugasan ini disampaikan, atas perhatian dan kehadiran Bapak diucapkan terima kasih
        <br><br>
        Waalahu Waliyyut Taufiq wal-Hidayah
    </p>

    <div class="legalitor">
        Makassar,
        {{ \Carbon\Carbon::parse($permohonan->tanggal_surat)->format('d F Y') }}
        <br>
        Dekan
    </div>
    <br>
    <br>
    <div style="text-align: center; position: relative">
        <img src="https://thesis.fikom.app/gambar/stempelfakultas.png" alt="" height="100px" style="position: absolute; right: 140px">
        <img src="https://thesis.fikom.app/gambar/ttd_dekan.png" alt="" height="70px" style="position: absolute; right: -20px">
    </div>
    <br><br><br><br>
    <div class="legalitor">
        <b><u>Purnawansyah, M.Kom</u></b>
    </div>
    <div style="text-align: center; position: relative">
        <img src="https://thesis.fikom.app/gambar/paraf_wd.png" alt="" height="50px" style="position: absolute; right: -20px">
    </div>
    <p align="justify">
        <i><u>Tembusan : </u>
            <br>
            1. Yayasan Wakaf UMI <br>
            2. Rektor UMI <br>
            3. Ketua Program Studi TI FIK UMI</i>
    </p>
</body>
</html> 
