<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInsentif extends Model
{
    use HasFactory;


    protected $fillable = [ 
        'skema_id',
        'insentif',
        'min_qty',
        'max_qty',
        'produk_id',

    ];

    public function skema() {
        return $this->belongsTo(Product::class, 'skema_id');
    }
}
