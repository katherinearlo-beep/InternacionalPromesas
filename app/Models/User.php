<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    // Relación uno a uno con Role
    public function roleRelation()
    {
        return $this->belongsTo(Role::class, 'role'); // 'role' es la columna role_id
    }

    // Método para verificar rol
    public function hasRole(string $roleName): bool
    {
        return $this->roleRelation && $this->roleRelation->name === $roleName;
    }
}
