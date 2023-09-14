<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Artikel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul_artikel',
        'gambar_artikel',
        'isi_artikel',
        
        
        
    ];

    // app/Models/Artikel.php

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function boot()
{
    parent::boot();

    // Event "updating" dipicu ketika entitas diperbarui
    static::updating(function ($item) {
        // Ambil ID pengguna yang saat ini sedang masuk
        $loggedInUser = auth()->user();
$loggedInUsername = $loggedInUser->nama; // Ganti "name" dengan kolom yang sesuai di tabel pengguna.


        // Set kolom "updated_by" dengan ID pengguna yang sedang masuk
        $item->updated_by = $loggedInUsername;
    });
}


    

public function updatedByUser()
{
    return $this->belongsTo(User::class, 'updated_by');
}


}


