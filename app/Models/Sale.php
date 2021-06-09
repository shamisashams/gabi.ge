<?php
/**
 *  app/Models/Setting.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeSaleFilter;
use App\Traits\ScopeSettingFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Sale extends Model
{
    use HasFactory, Notifiable, ScopeSaleFilter, HasRolesAndPermissions, SoftDeletes;

    const TYPE_PERCENT = "percent";
    const TYPE_FIXED = "fixed";

    protected $fillable = [
        'title',
        'discount',
        'type'
    ];

    public function language()
    {
        return $this->hasMany(SaleLanguage::class, 'sale_id');
    }

    public function availableLanguage()
    {
        return $this->language()->where('language_id', '=', Language::getIdByName(app()->getLocale()));
    }

    public function getFilterScopes(): array
    {
        return [
            'id' => [
                'hasParam' => true,
                'scopeMethod' => 'id'
            ],
            'title' => [
                'hasParam' => true,
                'scopeMethod' => 'title'
            ],
            'discount' => [
                'hasParam' => true,
                'scopeMethod' => 'discount'
            ],
            'type' => [
                'hasParam' => true,
                'scopeMethod' => 'type'
            ],
        ];
    }
}
