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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\throwException;

class Language extends Model
{
    use HasFactory;

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
    public static function getIdByName(string $lang) {
        $localization = Language::where('abbreviation',$lang)->first();
        if ($localization == null) {
            throwException('Localization not exist.');
        }
        return $localization->id;
    }

//    public function dictionaryLanguages()
//    {
//        return $this->hasMany(DictionaryLanguage::class, 'language_id');
//    }
}
