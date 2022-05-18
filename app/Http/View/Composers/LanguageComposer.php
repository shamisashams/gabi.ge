<?php
/**
 *  app/Http/View/Composers/MenuComposer.php
 *
 * User:
 * Date-Time: 28.10.20
 * Time: 14:33
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\View\Composers;

use App\Models\CategoryLanguage;
use App\Models\Language;
use App\Models\Localization;
use App\Models\PageLanguage;
use App\Models\ProductLanguage;
use Illuminate\View\View;

class LanguageComposer
{

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('globalLanguages', $this->languageItems());
    }

    public function languageItems()
    {
        $localizations = Language::where('status', true)->get();

        $languages = [];
        $languages['data'] = [];
        if (count($localizations) > 0) {
            foreach ($localizations as $localization) {
                if ($localization->abbreviation == app()->getLocale()) {
//                    $languages['abbreviations'][] = $localization->abbreviation;
                    $languages['current']= [
                        'title' => $localization->title,
                        'url' => '',
                        'img' => $localization->abbreviation . '.png',
                        'abbreviation' => $localization->abbreviation
                    ];
                }
                $languages['abbreviations'][] = $localization->abbreviation;
                $languages['data'][]= [
                    'title' => $localization->title,
                    'url' => $this->getUrl($localization->abbreviation),
                    'img' => $localization->abbreviation . '.png',
                    'abbreviation' => $localization->abbreviation
                ];
            }
        }
       return $languages;

    }

    protected function getUrl($lang) {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $replaceLang = '/'.app()->getLocale();
        $replaceBy = '/'.$lang;
        if(request()->route()){
            $params = request()->route()->parameters();
            if (request()->route()->named('catalogueSeo')) {

                $cat = CategoryLanguage::query()->where('slug',$params['category'])->first();
                if ($cat){
                    $language_id = Language::getIdByName($lang);
                    $cat = CategoryLanguage::query()->where('category_id',$cat->category_id)->where('language_id',$language_id)->first();
                    if($cat)
                        return route('catalogueSeo',['locale' => $lang,'category' => $cat->slug]);
                }

            } elseif (request()->route()->named('productDetailsSeo')){

                $cat = CategoryLanguage::query()->where('slug',$params['category'])->first();
                $prod = ProductLanguage::query()->where('slug',$params['product'])->first();
                if($cat && $prod){
                    $language_id = Language::getIdByName($lang);
                    $cat = CategoryLanguage::query()->where('category_id',$cat->category_id)->where('language_id',$language_id)->first();
                    $prod = ProductLanguage::query()->where('product_id',$prod->product_id)->where('language_id',$language_id)->first();
                    if($cat && $prod)
                        return route('productDetailsSeo',['locale' => $lang,'category' => $cat->slug, 'product' => $prod->slug]);
                }


            } elseif (request()->route()->named('viewPage')) {
                $page = PageLanguage::query()->where('slug',$params['slug'])->first();
                if ($page){
                    $language_id = Language::getIdByName($lang);
                    $page = PageLanguage::query()->where('page_id',$page->page_id)->where('language_id',$language_id)->first();
                    if($page)
                        return route('viewPage',['locale' => $lang,'slug' => $page->slug]);
                }
            }

            else {
                return str_replace($replaceLang,$replaceBy,$actual_link);
            }
        } else {
            return str_replace($replaceLang,$replaceBy,$actual_link);
        }


    }
}
