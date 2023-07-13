<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Mahasiswa;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        } else {
            // Jika foto belum diisi, mengembalikan URL dengan singkatan dari nama lengkap
            $initials = '';
            $nameParts = explode(' ', $this->name);
            foreach ($nameParts as $part) {
                $initials .= strtoupper(mb_substr($part, 0, 1));
            }

            return "https://ui-avatars.com/api/?name={$initials}&background=007BFF&color=FFF";
        }
    }
}
