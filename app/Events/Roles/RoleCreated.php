<?php

namespace App\Events\Roles;

use HMS\Entities\Role;
use Illuminate\Queue\SerializesModels;

class RoleCreated
{
    use SerializesModels;

    /**
     * @var HMS\Entities\Role
     */
    public $role;

    /**
     * Create a new event instance.
     *
     * @param HMS\Entities\Role $role
     */
    public function __construct(Role $role)
    {
        //
        $this->role = $role;
    }
}
