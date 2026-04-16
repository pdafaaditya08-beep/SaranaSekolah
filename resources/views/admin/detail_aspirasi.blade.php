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

        .success {
            color: green;
            margin-bottom: 10px;
        }

        ul {
            padding-left: 20px;
        }

        textarea {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-top: 5px;
        }

        select {
            padding: 8px;
            border-radius: 5px;
            margin-top: 5px;
        }

        button {
            margin-top: 10px;
            padding: 8px 15px;
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

        .status {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Detail Aspirasi</h1>

    {{-- DETAIL --}}
    <div class="card">
        <h3>{{ $aspirasi->judul }}</h3>

        <p>
            <strong>Pengirim:</strong>
            {{ $aspirasi->user->name ?? 'User tidak ditemukan' }}
        </p>

        <p>
            <strong>NIS:</strong>
            {{ $aspirasi->user->nis ?? '-' }}
        </p>

        <p>
            <strong>Kelas:</strong>
            {{ $aspirasi->user->kelas ?? '-' }}
        </p>

        <p>
            <strong>Kategori:</strong>
            {{ $aspirasi->kategori->nama_kategori ?? 'Kategori tidak ditemukan' }}
        </p>

        <p>
            <strong>Isi:</strong>
            {{ $aspirasi->isi }}
        </p>

        <p>
            <strong>Status:</strong>
            <span class="status">{{ ucfirst($aspirasi->status) }}</span>
        </p>

        <p>
            <strong>Dikirim pada:</strong>
            {{ $aspirasi->created_at->format('d M Y H:i') }}
        </p>
    </div>

    {{-- FEEDBACK --}}
    <div class="card">
        <h3>Feedback</h3>

        @if(session('success_feedback'))
            <p class="success">{{ session('success_feedback') }}</p>
        @endif

        <ul>
            @forelse($aspirasi->feedback as $fb)
                <li>
                    <strong>{{ $fb->created_at->format('d M Y H:i') }}:</strong>
                    {{ $fb->isi_feedback }}
                </li>
            @empty
                <li>Belum ada feedback</li>
            @endforelse
        </ul>

        <form action="{{ route('admin.aspirasi.feedback', $aspirasi->id) }}" method="POST">
            @csrf
            <textarea name="isi_feedback" rows="3" placeholder="Tulis feedback..." required></textarea>
            <button type="submit">Tambah Feedback</button>
        </form>
    </div>

    {{-- STATUS UPDATE --}}
    <div class="card">
        <h3>Update Status Aspirasi</h3>

        @if(session('success_progress'))
            <p class="success">{{ session('success_progress') }}</p>
        @endif

        <form action="{{ route('admin.aspirasi.progress', $aspirasi->id) }}" method="POST">
            @csrf

            <label>Pilih Status:</label><br>

            <select name="status" required>
                <option value="dikirim" {{ $aspirasi->status == 'dikirim' ? 'selected' : '' }}>
                    Dikirim
                </option>
                <option value="diproses" {{ $aspirasi->status == 'diproses' ? 'selected' : '' }}>
                    Diproses
                </option>
                <option value="selesai" {{ $aspirasi->status == 'selesai' ? 'selected' : '' }}>
                    Selesai
                </option>
            </select>

            <br>

            <button type="submit">Update Status</button>
        </form>
    </div>

    {{-- BACK --}}
    <a href="{{ route('admin.dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>