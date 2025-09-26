<?php

// app/Models/Module.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'ModuleID';
    protected $fillable = ['ModuleName'];

    public function entities()
    {
        return $this->hasMany(Entity::class, 'ModuleID');
    }
}