@extends('layouts.template')
@section('content')
<html>
<head>
    <title>Dosen Jurusan Teknologi Informasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            color: #3f3d56;
        }
        .profile-card {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .profile-card img {
            display: block;
            margin: 0 auto;
            width: 100px;
            height: 100px;
            border-radius: 5px;
            background-color: #e0e0e0;
        }
        .profile-card table {
            width: 100%;
            margin-top: 20px;
        }
        .profile-card table td {
            padding: 5px;
        }
        .profile-card table td:first-child {
            font-weight: bold;
        }
        .tabs {
            margin-bottom: 20px;
        }
        .tabs .btn {
            margin-right: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .btn-success {
            background-color: #28a745;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .table-responsive {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            text-align: left;
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dosen Jurusan Teknologi Informasi</h1>
        </div>
        <div class="profile-card">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="https://placehold.co/100x100" alt="Profile picture placeholder">
                </div>
                <div class="col-md-8">
                    <table>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>Nama Dosen, S.ST., MT.</td>
                        </tr>
                        <tr>
                            <td>NIP</td>
                            <td>197710306005412005</td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>Sistem Informasi Bisnis</td>
                        </tr>
                        <tr>
                            <td>Bidang Minat</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mata Kuliah</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="tabs">
            <button class="btn btn-success">Pelatihan</button>
            <button class="btn btn-primary">Sertifikasi</button>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama Pelatihan</th>
                        <th>id_mk</th>
                        <th>id_bidmin</th>
                        <th>id_vendor</th>
                        <th>id_periode</th>
                        <th>waktu_pelaksanaan</th>
                        <th>level_pelatihan</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add rows here -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

@endsection