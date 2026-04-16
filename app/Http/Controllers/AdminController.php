<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Feedback;
use App\Models\Progress;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * DASHBOARD ADMIN
     */
    public function dashboard(Request $request)
    {
        $query = Aspirasi::with(['user', 'kategori']);

        // FILTER TANGGAL
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        // FILTER KATEGORI
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // FILTER NAMA SISWA
        if ($request->filled('nama_siswa')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama_siswa . '%');
            });
        }

        $aspirasi = $query->latest()->get();
        $kategori = Kategori::all();

        return view('admin.dashboard', compact('aspirasi', 'kategori'));
    }

    /**
     * DETAIL ASPIRASI
     */
    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['user', 'kategori', 'feedback', 'progress'])
            ->findOrFail($id);

        return view('admin.detail_aspirasi', compact('aspirasi'));
    }

    /**
     * TAMBAH FEEDBACK
     */
    public function addFeedback(Request $request, $id)
    {
        $request->validate([
            'isi_feedback' => 'required|string',
        ]);

        Feedback::create([
            'aspirasi_id' => $id,
            'admin_id'     => Auth::id(),
            'isi_feedback' => $request->isi_feedback,
        ]);

        return back()->with('success_feedback', 'Feedback berhasil ditambahkan.');
    }

    /**
     * UPDATE STATUS / PROGRESS
     */
    public function addProgress(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:dikirim,diproses,selesai',
        ]);

        $aspirasi = Aspirasi::findOrFail($id);

        $aspirasi->update([
            'status' => $request->status
        ]);

        Progress::create([
            'aspirasi_id' => $aspirasi->id,
            'keterangan'   => 'Status diubah menjadi: ' . ucfirst($request->status),
        ]);

        return back()->with('success_progress', 'Status aspirasi berhasil diperbarui.');
    }

    /**
     * DELETE ASPIRASI
     */
    public function destroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);

        // hapus relasi dulu
        Feedback::where('aspirasi_id', $id)->delete();
        Progress::where('aspirasi_id', $id)->delete();

        // hapus data utama
        $aspirasi->delete();

        return back()->with('success', 'Aspirasi berhasil dihapus.');
    }
}