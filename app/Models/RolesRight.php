<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolesRight extends Model
{
    protected $table = 'rolesrights'; 
    public $timestamps = false; 

    // إذا الجدول ما فيه عمود ID تلقائي:
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = ['RoleID', 'EntityID', 'ActionID'];
}
