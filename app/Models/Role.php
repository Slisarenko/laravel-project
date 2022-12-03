<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];
    protected $table = 'roles';

    public const SUPERADMINISTRATOR = 1;
    public const ADMINISTRATOR = 2;
    public const USER = 3;
}
