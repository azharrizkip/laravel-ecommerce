<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name', 'gender', 'email', 'password', 'remember_token', 'role', // Add 'role' to the fillable attributes
    ];

    protected $hidden = [
        'password',
    ];

    public function buyer()
    {
        return $this->hasOne(Buyer::class);
    }

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Check if the user is a staff
    public function isStaff()
    {
        return $this->role === 'staff';
    }

    // Check if the user is a buyer
    public function isBuyer()
    {
        return $this->role === 'buyer';
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
}
