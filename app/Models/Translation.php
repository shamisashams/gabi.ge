<?php
/**
 *  app/Models/Localization.php
 *
 * User:
 * Date-Time: 07.12.20
 * Time: 11:59
 * @author Insite International <hello@insite.international>
 */

namespace App\Models;

use App\Traits\HasRolesAndPermissions;
use App\Traits\ScopeFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\TranslationLoader\LanguageLine;
use function PHPUnit\Framework\throwException;

class Translation extends LanguageLine
{
    use HasFactory, Notifiable, ScopeFilter, HasRolesAndPermissions, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'language_lines';

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
            'key' => [
                'hasParam' => true,
                'scopeMethod' => 'key'
            ],
            'group' => [
                'hasParam' => true,
                'scopeMethod' => 'group'
            ],
            'text' => [
                'hasParam' => true,
                'scopeMethod' => 'text'
            ],
        ];
    }

//    public function dictionaryLanguages()
//    {
//        return $this->hasMany(DictionaryLanguage::class, 'language_id');
//    }
}
