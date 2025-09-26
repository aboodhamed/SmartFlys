<?php

// app/Models/Entity.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'entities';
    protected $primaryKey = 'EntityID';
    protected $fillable = ['EntityName', 'ModuleID'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'ModuleID');
    }

    public function actions()
    {
        return $this->belongsToMany(Action::class, 'entity_actions', 'EntityID', 'ActionID');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rolerights', 'EntityID', 'RoleID')
                    ->withPivot('ActionID');
    }
}