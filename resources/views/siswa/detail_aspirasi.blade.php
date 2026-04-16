<!DOCTYPE html>

<html>
<head>
    <title>Detail Aspirasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

```
    .container {
        max-width: 800px;
        margin: auto;
    }

    .card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    h1, h3 {
        margin-top: 0;
    }

    p {
        margin: 8px 0;
    }

    ul {
        padding-left: 20px;
    }

    li {
        margin-bottom: 8px;
    }

    .status {
        font-weight: bold;
        color: #007bff;
    }

    .empty {
        color: gray;
        font-style: italic;
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

```
<h1>Detail Aspirasi</h1>

<div class="card">
    <h3>{{ $aspirasi->judul }}</h3>
    <p><strong>Kategori:</strong> {{ optional($aspirasi->kategori)->nama_kategori ?? 'Kategori tidak ditemukan' }}</p>
    <p><strong>Isi Aspirasi:</strong> {{ $aspirasi->isi }}</p>
    <p><strong>Status:</strong> <span class="status">{{ ucfirst($aspirasi->status) }}</span></p>
    <p><strong>Dikirim pada:</strong> {{ $aspirasi->created_at->format('d M Y H:i') }}</p>
</div>

<div class="card">
    <h3>Feedback dari Admin</h3>

    @if($aspirasi->feedback->count() > 0)
        <ul>
            @foreach($aspirasi->feedback as $fb)
                <li>
                    <strong>{{ $fb->created_at->format('d M Y H:i') }}:</strong>
                    {{ $fb->isi_feedback }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="empty">Belum ada feedback dari admin.</p>
    @endif
</div>

<div class="card">
    <h3>Progress Update</h3>

    @if($aspirasi->progress->count() > 0)
        <ul>
            @foreach($aspirasi->progress as $p)
                <li>
                    <strong>{{ $p->created_at->format('d M Y H:i') }}:</strong>
                    {{ $p->keterangan }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="empty">Belum ada update progres.</p>
    @endif
</div>

<a href="{{ route('siswa.dashboard') }}" class="back">← Kembali ke Dashboard</a>
```

</div>

</body>
</html>
