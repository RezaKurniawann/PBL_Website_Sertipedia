@extends('layouts.template')

@section('content')

<style>
    .search-bar {
        margin-bottom: 20px;
        position: relative;
    }

    .search-bar input {
        width: 100%;
        padding: 10px 40px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .search-bar i {
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        color: #aaa;
    }

    .dosen-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .dosen-card {
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        background-color: #fff;
    }

    .dosen-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 15px;
    }

    .dosen-card h5 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .dosen-card p {
        font-size: 14px;
        margin: 5px 0;
    }

    .dosen-card .btn {
        background-color: #0d6efd;
        color: #fff;
        padding: 8px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        display: inline-block;
    }

    .dosen-card .btn:hover {
        background-color: #0056b3;
    }
</style>

<div class="container mt-4">
    <h3 class="mb-4 text-center">Dosen Jurusan Teknologi Informasi</h3>
    <div class="search-bar">
        <i class="fa fa-search"></i>
        <input type="text" placeholder="Search..">
    </div>

    <div class="dosen-container">
        @foreach ($dosen as $d)
            <div class="dosen-card">
                <img src="{{ asset($d['foto']) }}" alt="Foto Dosen">
                <h5>{{ $d['nama'] }}</h5>
                <p>Profesi: {{ $d['profesi'] }}</p>
                <p>Keahlian: {{ $d['keahlian'] }}</p>
                <a href="#" class="btn">View Profile</a>
            </div>
        @endforeach
    </div>
</div>

@endsection
