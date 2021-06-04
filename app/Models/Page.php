<?php
/**
 *  app/Models/Page.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopePageFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Page extends Model
{
    use HasFactory, Notifiable, ScopePageFilter, HasRolesAndPermissions, SoftDeletes;

    protected $fillable = [
        'slug',
        'status'
    ];


    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function language()
    {
        return $this->hasMany(PageLanguage::class, 'page_id');
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
            'slug' => [
                'hasParam' => true,
                'scopeMethod' => 'slug'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
        ];
    }
}
