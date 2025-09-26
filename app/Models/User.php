<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'MobileNumber',
        'RoleID',
        'display_order',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'subscription_end_date' => 'datetime',
        ];
    }

    public function role() 
    {
    return $this->belongsTo(Role::class, 'RoleID');
    }

    // دالة للتحقق من الصلاحية
    public function hasPermission($entity, $action)
    {
        if (!$this->role) {
            return false; // لو ما عندو role، ما عندو صلاحيات
        }
        return $this->role->permissions()
            ->where('entity_id', $entity)
            ->where('action_id', $action)
            ->exists();
    }



    
}
