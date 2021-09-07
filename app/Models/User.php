<?php

namespace App\Models;

use App\Role\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory;

    public $timestamps = false;

    public function __construct()
    {
        $role = UserRole::ROLE_USER;
        $this->addRole($role);
    }

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'login',
        'password',
        'owedRentAmount'
    ];

    protected $casts = [
        'roles' => 'array'
    ];

    public function rentedCars()
    {
        return $this->hasMany(Car::class);
    }

    public function addRole(string $role)
    {
        $roles = $this->getRoles();
        $roles[] = $role;

        $roles = array_unique($roles);
        $this->setRoles($roles);

        return $this;
    }

    public function setRoles(array $roles)
    {
        $this->setAttribute('roles', $roles);
        return $this;
    }

    public function hasRole($role)
    {
        return in_array($role, $this->getRoles());
    }

    public function hasRoles(array $roles)
    {
        $currentRoles = $this->getRoles();
        foreach ($roles as $role) {
            if (!in_array($role, $currentRoles)) {
                return false;
            }
        }
        return true;
    }

    public function getRoles()
    {
        $roles = $this->getAttribute('roles');
        if (is_null($roles)) {
            $roles = [];
        }
        return $roles;
    }
}
