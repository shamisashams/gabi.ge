<?php
/**
 *  app/Http/Controllers/AboutController.php
 *
 * User:
 * Date-Time: 21.12.20
 * Time: 15:07
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
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
        $page = Page::join('page_languages', 'page_languages.page_id', '=', 'pages.id')
            ->where(['status' => true, 'page_languages.slug' => 'about-us'])->first();
        if (!$page) {
            return abort('404');
        }
        return view('pages.about-us.index', [
            'page' => $page
        ]);
    }
}
