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

use App\Models\Blog;
use App\Models\Faq;
use App\Models\Help;
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

        //dd($page);

        $page_redirect = Setting::query()->where('key','page_not_found_redirect')->first();
        $val = count($page_redirect->availableLanguage) > 0 ? $page_redirect->availableLanguage[0]->value : false;
        if((!$page) && $val){
            return redirect($val,301);
        } elseif (!$page){
            return abort(404);
        }

        switch ($page->type){
            case 'blogs':
                return view('pages.'. $page->type .'.index', [
                    'page' => $page,
                    'blogs' => Blog::with('availableLanguage')->paginate('6')
                ]);
                break;
            case 'helps':
                return view('pages.'. $page->type .'.index', [
                    'page' => $page,
                    'helps' => Help::with('availableLanguage')->get(),
                    'faqs' => Faq::with('availableLanguage')->get()
                ]);
                break;
            default:
                return view('pages.'. $page->type .'.index', [
                    'page' => $page
                ]);

        }


    }
}
