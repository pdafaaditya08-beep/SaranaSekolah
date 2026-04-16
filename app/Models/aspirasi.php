<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// IMPORT MODEL RELASI
use App\Models\User;
use App\Models\Kategori;
use App\Models\Feedback;
use App\Models\Progress;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'isi',
        'status',
    ];

    /**
     * RELASI KE USER (SISWA)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * RELASI KE KATEGORI
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * RELASI FEEDBACK (ADMIN)
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'aspirasi_id');
    }

    /**
     * RELASI PROGRESS / STATUS HISTORY
     */
    public function progress()
    {
        return $this->hasMany(Progress::class, 'aspirasi_id');
    }
}