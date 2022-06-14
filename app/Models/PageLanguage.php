<?php
/**
 *  app/Models/PageLanguage.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Insite International <hello@insite.international>
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id',
        'language_id',
        'slug',
        'title',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'content',
    ];

}
