<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Akses extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_akses',
        
    ];
    public function User()
    {

        return $this->hasMany(User::class);
    }

}
