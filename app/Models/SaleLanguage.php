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
use App\Traits\ScopeSettingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class SaleLanguage extends Model
{
    use HasFactory, Notifiable, ScopeSettingFilter, HasRolesAndPermissions;



    protected $fillable = [
        'title',
        'sale_id',
        'language_id',
    ];

    public function sale()
    {
        return $this->belongsTo('App\Models\Sale', 'sale_id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Localization', 'language_id');
    }


}
