<!DOCTYPE html>

<html>
<head>
    <title>Kelola Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

```
    .container {
        max-width: 900px;
        margin: auto;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    h1 {
        margin-bottom: 15px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .btn {
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
    }

    .btn-add {
        background: #28a745;
    }

    .btn-edit {
        background: #ffc107;
        color: black;
    }

    .btn-delete {
        background: #dc3545;
        border: none;
        color: white;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 5px;
    }

    .success {
        color: green;
        margin-bottom: 10px;
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

    .back {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #007bff;
    }
</style>
```

</head>
<body>

<div class="container">
    <div class="card">

```
    <div class="top-bar">
        <h1>Kelola Kategori</h1>
        <a href="{{ route('kategori.create') }}" class="btn btn-add">+ Tambah</a>
    </div>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <table>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>

        @foreach($kategori as $index => $k)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $k->nama_kategori }}</td>
            <td>{{ $k->deskripsi }}</td>
            <td>
                <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-edit">Edit</a>

                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    <a href="{{ route('admin.dashboard') }}" class="back">← Kembali</a>

</div>
```

</div>

</body>
</html>
