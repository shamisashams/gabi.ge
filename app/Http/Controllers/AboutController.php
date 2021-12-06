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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class AboutController extends Controller
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
        $page = Page::where(['status' => true, 'type' => 'about-us'])->with('availableLanguage')->first();

        if (!$page) {
            return abort('404');
        }
        return view('pages.about-us.index', [
            'page' => $page
        ]);
    }
}
