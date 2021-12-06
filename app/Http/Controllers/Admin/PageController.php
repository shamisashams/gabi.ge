<?php
/**
 *  app/Http/Controllers/Admin/PageController.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Insite International <hello@insite.international>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\FeatureRequest;
use App\Http\Request\Admin\PageRequest;
use App\Repositories\PageRepositoryInterface;
use App\Services\PageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class PageController extends AdminController
{
    protected $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }


    /**
     * Display a listing of the resource.
     * @param string $lang
     * @return Application|Factory|View|Response
     */
    public function index(string $lang, Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'slug' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);
        return view('admin.modules.page.index', [
            'pages' => $this->pageRepository->getData($request, ['availableLanguage'])
        ]);

    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return Application|Factory|View|Response
//     */
//    public function create(string $locale)
//    {
//        return redirect(route('pageIndex', $locale));
//        return view('admin.modules.page.create');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param string $lang
//     * @param FeatureRequest $request
//     * @return Application|RedirectResponse|Response|Redirector
//     */
//    public function store(string $locale, PageRequest $request)
//    {
//        $data = $request->only([
//            'title',
//            'meta_title',
//            'slug',
//            'description',
//            'content',
//            'content_2',
//            'content_3',
//            'content_4',
//            'status'
//        ]);
//        if (!$this->service->store($locale, $data)) {
//            return redirect(route('pageCreateView', $locale))->with('danger', 'Page does not create.');
//        }
//
//        return redirect(route('pageIndex', $locale))->with('success', 'Page create successfully.');
//
//    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.page.view', [
            'page' => $this->pageRepository->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        return view('admin.modules.page.update', [
            'page' => $this->pageRepository->find($id)
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param FeatureRequest $request
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, PageRequest $request, int $id)
    {
        if (!$this->pageRepository->update($locale, $id, $request)) {
            return redirect(route('pageEditView', [$locale, $id]))->with('danger', __('admin.page_not_update'));
        }

        return redirect(route('pageIndex', $locale))->with('success', __('admin.page_success_update'));

    }
}
