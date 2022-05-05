<?php
/**
 *  app/Http/Controllers/AboutController.php
 *
 * User:
 * Date-Time: 21.12.20
 * Time: 15:07
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application
     */
    public function viewPage(string $lang, $slug = null)
    {
        //$path = request()->getPathInfo();
//dd($slug);
        $page = Page::where(['status' => true])
            ->whereHas('language',function ($query) use ($slug){
                $query->where('slug',$slug);
            })
            ->with('availableLanguage')
            ->first();

        $page_redirect = Setting::query()->where('key','page_not_found_redirect')->first();
        $val = count($page_redirect->availableLanguage) > 0 ? $page_redirect->availableLanguage[0]->value : false;
        if((!$page) && $val){
            return redirect($val,301);
        } elseif (!$page){
            return abort(404);
        }

        return view('pages.'. $page->type .'.index', [
            'page' => $page
        ]);
    }
}
