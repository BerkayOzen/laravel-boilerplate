<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, Uuid, SoftDeletes;

    public $guard_name = 'api';

    public function setGuardNameAttribute()
    {
        $this->attributes['guard_name'] = $this->guard_name;
    }
}
