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

        h1 {
            margin-bottom: 5px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
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

        button {
            padding: 6px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: red;
            color: white;
        }

        button:hover {
            background: darkred;
        }
    </style>
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

            
            <form action="{{ route('siswa.aspirasi.destroy', $a->id) }}"
                  method="POST"
                  style="display:inline;"
                  onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                @csrf
                @method('DELETE')

                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<p>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>
</p>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
    @csrf
</form>

</div>
</body>
</html>