<?php
/**
 *  app/Http/View/Composers/SettingComposer.php
 *
 * User:
 * Date-Time: 13.01.21
 * Time: 16:57
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\View\Composers;

use App\Models\Category;
use App\Models\Localization;
use App\Models\Page;
use App\Models\Setting;
use App\Repositories\Frontend\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\View\View;

class PageComposer
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {

        $view->with('page_slugs', $this->getPages());
    }

    protected function getPages()
    {
        $pages = Page::all();
        $result = [];
        foreach ($pages as $page){
            if($page->type){
                $result[$page->type] = [
                    'slug' => count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->slug : null
                ];
            }
        }

        //dd($result);
        return $result;
    }

}
