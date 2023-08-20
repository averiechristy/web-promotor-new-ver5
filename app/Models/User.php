<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'akses_id',
        'role_id',
        'nama',
        'password',
        'username',
        'email',
        'phone_number',
        'avatar',
        'number',
        'kode_user',
    ];

    public function Akses()
    {

        return $this->belongsTo(Akses::class);
    }

    public function Role()
    {

        return $this->belongsTo(UserRole::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function generateCustomID()
{
    // Logic untuk menghasilkan custom ID, misalnya menggunakan timestamp dan role
    $timestamp = now()->format('YmdHis');
    $role = auth()->user()->kode_role; // Anda dapat mengubah sumber role sesuai kebutuhan
    $customID = $role . '-' . $timestamp;
    
    return $customID;
}

public static function boot(){
    parent::boot();
    static::creating(function($model){
        $model->number = Product::where('role_id', $model->role_id)->max('number')+1;
        $model->kode_user = $model->Role->kode_role . '-' .str_pad($model->number,5,'0',STR_PAD_LEFT);
    });
}
}
