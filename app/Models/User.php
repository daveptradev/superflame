<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\SuperflameVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyikan (security)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * RELATION (optional - untuk future)
     */

    // Contoh relasi ke order (kalau nanti kamu buat tabel orders)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function sendEmailVerificationNotification()
{
    $this->notify(
        new SuperflameVerifyEmail
    );
}

public function wishlists()
{
    return $this->hasMany(\App\Models\Wishlist::class);
}

}