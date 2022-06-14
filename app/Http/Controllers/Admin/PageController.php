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
use App\Models\Faq;
use App\Models\Help;
use App\Repositories\Eloquent\FaqRepository;
use App\Repositories\Eloquent\HelpRepository;
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
    private $helpRepository;
    private $faqRepository;

    public function __construct(PageRepositoryInterface $pageRepository, HelpRepository $helpRepository, FaqRepository $faqRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->helpRepository = $helpRepository;
        $this->faqRepository = $faqRepository;
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
            'pages' => $this->pageRepository->getData($request, ['availableLanguage']),

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
            'page' => $this->pageRepository->find($id),
            'helps' => Help::all(),
            'faqs' => Faq::all()
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

    public function addHelp(){
        return view('admin.modules.page.create-help', [
            'help' => new Help,
            'method' => 'post',
            'action' => route('addHelpStore',app()->getLocale())
        ]);
    }

    public function addHelpStore($locale,Request $request){

        $request->validate([
           'title' => 'required'
        ]);

        if (!$this->helpRepository->store($locale, $request)) {
            return redirect(route('pageEditView',[$locale,5]))->with('danger', __('admin.category_not_created'));
        }

        return redirect(route('pageEditView',[$locale,5]))->with('success', __('admin.category_created_succesfully'));
    }

    public function editHelp(string $lang, Help $help)
    {
        return view('admin.modules.page.create-help', [
            'help' => $help,
            'method' => 'put',
            'action' => route('helpUpdate',[app()->getLocale(),$help])
        ]);
    }

    public function updateHelp(string $lang, Help $help, Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        if (!$this->helpRepository->update($lang, $help->id, $request)) {
            return redirect(route('pageIndex', [$lang, $help->id]))->with('danger', __('admin.page_not_update'));
        }

        return redirect(route('pageEditView',[$lang,5]))->with('success', __('admin.page_success_update'));
    }

    public function addFaq(){
        return view('admin.modules.page.create-faq', [
            'help' => new Faq(),
            'method' => 'post',
            'action' => route('faqStore',app()->getLocale())
        ]);
    }

    public function faqStore($locale,Request $request){

        //dd($request->all());
        $request->validate([
            'question' => 'required'
        ]);

        if (!$this->faqRepository->store($locale, $request)) {
            return redirect(route('pageEditView',[$locale,5]))->with('danger', __('admin.category_not_created'));
        }

        return redirect(route('pageEditView',[$locale,5]))->with('success', __('admin.category_created_succesfully'));
    }

    public function editFaq(string $lang, Faq $faq)
    {
        return view('admin.modules.page.create-faq', [
            'help' => $faq,
            'method' => 'put',
            'action' => route('faqUpdate',[app()->getLocale(),$faq])
        ]);
    }

    public function updateFaq(string $lang, Faq $faq, Request $request)
    {
        $request->validate([
            'question' => 'required'
        ]);
        if (!$this->faqRepository->update($lang, $faq->id, $request)) {
            return redirect(route('pageEditView',[$lang,5]))->with('danger', __('admin.page_not_update'));
        }

        return redirect(route('pageEditView',[$lang,5]))->with('success', __('admin.page_success_update'));
    }

    public function deleteHelp($locale, Help $help){
        $help->delete();
        return redirect(route('pageEditView',[$locale,5]))->with('success', __('admin.success_delete'));
    }

    public function deleteFaq($locale, Faq $faq){
        $faq->delete();
        return redirect(route('pageEditView',[$locale,5]))->with('success', __('admin.success_delete'));
    }
}
