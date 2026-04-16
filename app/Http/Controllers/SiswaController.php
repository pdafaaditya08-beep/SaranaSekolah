<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    // Dashboard siswa
    public function dashboard()
    {
        $aspirasi = Aspirasi::with('kategori')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $user = Auth::user();

        return view('siswa.dashboard', compact('aspirasi', 'user'));
    }

    // Form tambah aspirasi
    public function createAspirasi()
    {
        $kategori = Kategori::all();
        $user = Auth::user();

        return view('siswa.create_aspirasi', compact('kategori', 'user'));
    }

    // Simpan aspirasi baru
    public function storeAspirasi(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'judul'       => 'required|string|max:150',
            'isi'         => 'required|string',
        ]);

        Aspirasi::create([
            'user_id'     => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'judul'       => $request->judul,
            'isi'         => $request->isi,
            'status'      => 'dikirim',
        ]);

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Aspirasi berhasil dikirim.');
    }

    // Detail aspirasi
    public function detailAspirasi($id)
    {
        $aspirasi = Aspirasi::with(['kategori', 'feedback', 'progress'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        $user = Auth::user();

        return view('siswa.detail_aspirasi', compact('aspirasi', 'user'));
    }

    // =========================
    // HAPUS ASPIRASI (BARU)
    // =========================
    public function destroy($id)
    {
        $aspirasi = Aspirasi::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $aspirasi->delete();

        return redirect()
            ->route('siswa.dashboard')
            ->with('success', 'Aspirasi berhasil dihapus.');
    }
}