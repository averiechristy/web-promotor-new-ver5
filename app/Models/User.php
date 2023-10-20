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
        'created_by',
        'updated_by',
    ];

    
    public function Akses()
    {

        return $this->belongsTo(Akses::class);
    }


    public function LeaderBoard()
    {

        return $this->hasMany(LeaderBoard::class);
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
public static function boot()
{
    parent::boot();
    static::creating(function($model){
        $roleId = UserRole::find($model->role_id)->kode_role; // Ambil kode role dari relasi Role
        $dateFormatted = now()->format('ym'); // Format tahun dan bulan yymm
        $model->number = static::where('role_id', $model->role_id)->max('number') + 1;
        $model->kode_user = $roleId . $dateFormatted . str_pad($model->number, 3, '0', STR_PAD_LEFT);
    });

  
    
        // Event "updating" dipicu ketika entitas diperbarui
 
    
}

public function isAdmin()
{
    $jenis_akses = $this->Akses->jenis_akses;
    return strtoupper($jenis_akses) === 'ADMIN';
}
public function createdByUser()
{
    return $this->belongsTo(User::class, 'created_by');
}



// app/Models/User.php

public function setDefaultAvatar()
{
    $this->avatar = 'default.jpg'; // Ganti dengan nama file default yang sesuai
    $this->save();
}

public function uploadAvatar($avatar)
{
    $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
    $avatar->move(public_path('avatars'), $avatarName);
    
    $this->avatar = $avatarName;
    $this->save();
}

public function deleteAvatar()
{
    if ($this->avatar !== 'default.jpg') {
        // Hapus foto profil asalkan bukan default
        unlink(public_path('avatars/' . $this->avatar));
        $this->setDefaultAvatar();
    }
}




}
