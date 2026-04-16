<!DOCTYPE html>

<html>
<head>
    <title>Siswa Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

```
    h1 {
        margin-bottom: 5px;
    }

    .container {
        max-width: 1100px;
        margin: auto;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    form label {
        display: block;
        margin-top: 10px;
        font-size: 14px;
    }

    form input, form select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .form-group {
        flex: 1;
        min-width: 200px;
    }

    button {
        margin-top: 15px;
        padding: 10px 15px;
        border: none;
        background: #007bff;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #0056b3;
    }

    .btn-reset {
        background: gray;
        text-decoration: none;
        padding: 10px 15px;
        color: white;
        border-radius: 5px;
        margin-left: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th {
        background: #007bff;
        color: white;
    }

    table th, table td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    table tr:hover {
        background: #f1f1f1;
    }

    .menu a {
        text-decoration: none;
        color: #007bff;
    }

    .logout {
        margin-top: 15px;
        display: inline-block;
        color: red;
        cursor: pointer;
    }
</style>
```

</head>
<body>
    <div class="container">

<h1>Dashboard Siswa</h1>
<p>Selamat datang, {{ Auth::user()->name }}</p>

<p><a href="{{ route('siswa.aspirasi.create') }}">Tambah Aspirasi Baru</a></p>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<h3>Daftar Aspirasi Anda</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    @foreach($aspirasi as $index => $a)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $a->judul }}</td>
        <td>{{ optional($a->kategori)->nama_kategori ?? 'Kategori tidak ditemukan' }}</td>
        <td>{{ $a->status }}</td>
        <td>{{ $a->created_at->format('d-m-Y') }}</td>
        <td>
            <a href="{{ route('siswa.aspirasi.detail', $a->id) }}">Detail</a>
        </td>
    </tr>
    @endforeach
</table>

<p>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
</p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>
