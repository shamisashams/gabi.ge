<?php
/**
 *  app/Models/Role.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 13:26
 * @author Insite International <hello@insite.international>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function allRolePermissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'users_roles');
    }
}
