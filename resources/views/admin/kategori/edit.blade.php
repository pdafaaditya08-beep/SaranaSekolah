<!DOCTYPE html>

<html>
<head>
    <title>Edit Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

```
    .container {
        max-width: 500px;
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

    input, textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    textarea {
        resize: vertical;
        min-height: 80px;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #ffc107;
        color: black;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background: #e0a800;
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
    <h1>Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Kategori:</label>
        <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>

        <label>Deskripsi:</label>
        <textarea name="deskripsi">{{ $kategori->deskripsi }}</textarea>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('kategori.index') }}" class="back">← Kembali</a>

</div>
```

</div>

</body>
</html>
