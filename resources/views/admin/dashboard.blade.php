<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

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

        .logout {
            margin-top: 15px;
            display: inline-block;
            color: red;
            cursor: pointer;
            text-decoration: none;
        }

        .delete-btn {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Admin Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}</p>

    {{-- FILTER --}}
    <div class="card">
        <h3>Filter Aspirasi</h3>

        <form method="GET" action="{{ route('admin.dashboard') }}">
            <div class="form-row">

                <div class="form-group">
                    <label>Tanggal:</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}">
                </div>

                <div class="form-group">
                    <label>Kategori:</label>
                    <select name="kategori_id">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}"
                                {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Siswa:</label>
                    <input type="text" name="nama_siswa"
                        value="{{ request('nama_siswa') }}"
                        placeholder="Cari nama siswa...">
                </div>

            </div>

            <button type="submit">Filter</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-reset">Reset</a>
        </form>
    </div>

    {{-- TABLE --}}
    <div class="card">
        <h3>Daftar Aspirasi</h3>

        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        <table>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Pengirim</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            @forelse($aspirasi as $index => $a)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $a->judul }}</td>
                <td>{{ $a->user->name ?? '-' }}</td>
                <td>{{ $a->user->nis ?? '-' }}</td>
                <td>{{ $a->user->kelas ?? '-' }}</td>
                <td>{{ $a->status }}</td>
                <td>{{ $a->created_at->format('d-m-Y') }}</td>

                <td>
                    <a href="{{ route('admin.aspirasi.detail', $a->id) }}">
                        Detail
                    </a>

                    |

                    {{-- DELETE --}}
                    <form action="{{ route('admin.aspirasi.destroy', $a->id) }}"
                          method="POST"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="delete-btn"
                                onclick="return confirm('Yakin ingin menghapus aspirasi ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" align="center">Tidak ada data ditemukan</td>
            </tr>
            @endforelse

        </table>
    </div>

    {{-- MENU --}}
    <div class="card">
        <h3>Menu Admin</h3>
        <ul>
            <li><a href="{{ route('kategori.index') }}">Kelola Kategori</a></li>
        </ul>
    </div>

    {{-- LOGOUT --}}
    <a href="{{ route('logout') }}"
       class="logout"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>

</div>

</body>
</html>