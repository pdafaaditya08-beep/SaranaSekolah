<!DOCTYPE html>

<html>
<head>
    <title>Tambah Aspirasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

```
    .container {
        max-width: 600px;
        margin: auto;
    }

    .card {
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    }

    h1 {
        margin-bottom: 20px;
    }

    label {
        font-size: 14px;
    }

    input, select, textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    textarea {
        resize: vertical;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #0056b3;
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
    <h1>Tambah Aspirasi Baru</h1>

    <form action="{{ route('siswa.aspirasi.store') }}" method="POST">
        @csrf

        <label>Kategori:</label>
        <select name="kategori_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
            @endforeach
        </select>

        <label>Judul:</label>
        <input type="text" name="judul" required>

        <label>Isi Aspirasi:</label>
        <textarea name="isi" rows="5" required></textarea>

        <button type="submit">Kirim Aspirasi</button>
    </form>

    <a href="{{ route('siswa.dashboard') }}" class="back">← Kembali ke Dashboard</a>

</div>
```

</div>

</body>
</html>
