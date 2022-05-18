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
use App\Models\Language;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     *
     * @return Application
     */
    public function index(string $lang, Request $request)
    {
        /*$page = Page::where(['status' => true, 'type' => 'about-us'])->with('availableLanguage')->first();

        if (!$page) {
            return abort('404');
        }


        return view('pages.'. $page->type .'.index', [
            'page' => $page
        ]);*/
    }

    public function viewBlog($locale, $slug){

        $localizationID = Language::getIdByName(app()->getLocale());

        $blog = Blog::query()->whereHas('language',function ($query) use ($slug, $localizationID){
            $query->where('slug', $slug)->where('language_id', $localizationID);
        })->with(['availableLanguage', 'files'])->firstOrFail();


        Blog::query()->where('id',$blog->id)
            ->increment('views', 1);


        //dd($blog);
        $blogs = Blog::with(['availableLanguage', 'firstImage'])->where('id','!=', $blog->id)->limit(3)->inRandomOrder()->get();

        return view('pages.single-blog.index',compact('blog','blogs'));
    }
}
