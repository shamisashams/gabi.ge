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

class SaleProduct extends Model
{
    use HasFactory, Notifiable, ScopeSettingFilter, HasRolesAndPermissions, SoftDeletes;

    protected $fillable = [
        'sale_id',
        'product_id'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'id','sale_id');
    }

}
