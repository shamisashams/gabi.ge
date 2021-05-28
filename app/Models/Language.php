<?php
/**
 *  app/Models/Localization.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 11:59
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use function PHPUnit\Framework\throwException;

class Language extends Model
{
    use HasFactory, Notifiable, ScopeFilter, HasRolesAndPermissions, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'abbreviation',
        'native',
        'locale',
        'status',
        'default'
    ];
    protected $table = 'languages';

    /**
     * Create localization item into db.
     *
     * @param string $lang
     * @return Language
     * @throws \Exception
     */
    public static function getIdByName(string $lang)
    {
        $localization = Language::where('abbreviation', $lang)->first();
        if ($localization == null) {
            throwException('Localization not exist.');
        }
        return $localization->id;
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
            'abbreviation' => [
                'hasParam' => true,
                'scopeMethod' => 'abbreviation'
            ],
            'native' => [
                'hasParam' => true,
                'scopeMethod' => 'native'
            ],
            'locale' => [
                'hasParam' => true,
                'scopeMethod' => 'locale'
            ],
            'status' => [
                'hasParam' => true,
                'scopeMethod' => 'status'
            ],
            'default' => [
                'hasParam' => true,
                'scopeMethod' => 'default'
            ]
        ];
    }

//    public function dictionaryLanguages()
//    {
//        return $this->hasMany(DictionaryLanguage::class, 'language_id');
//    }
}
