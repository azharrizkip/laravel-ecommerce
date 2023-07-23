<?php
// app/Models/Buyer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Kolom name di tabel buyers
        'birth_date', // Kolom birth_date di tabel buyers
        'gender', // Kolom gender di tabel buyers
        'address', // Kolom address di tabel buyers
        'ktp_image_path', // Kolom ktp_image_path di tabel buyers
        'user_id', // Kolom user_id di tabel buyers
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
