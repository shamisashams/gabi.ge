<?php
/**
 *  app/Models/Permission.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 13:38
 * @author Insite International <hello@insite.international>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }
}
