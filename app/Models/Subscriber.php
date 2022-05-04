<?php
/**
 *  app/Models/Setting.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Insite International <hello@insite.international>
 */

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeSaleFilter;
use App\Traits\ScopeSettingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Subscriber extends Model
{
    use HasFactory, Notifiable, ScopeSaleFilter;


    protected $fillable = [
        'email',
    ];



    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'email' => [
                'hasParam' => true,
                'scopeMethod' => 'email'
            ],
        ];
    }
}
