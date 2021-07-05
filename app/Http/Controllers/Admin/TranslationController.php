<?php
/**
 *  app/Http/Controllers/Admin/LocalizationController.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\LanguageRequest;
use App\Http\Request\Admin\TranslationRequest;
use App\Repositories\Eloquent\LanguageRepository;
use App\Repositories\LanguageRepositoryInterface;
use App\Repositories\TranslationRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class TranslationController extends AdminController
{
    protected $translationRepository;
    protected $languageRepository;

    public function __construct(TranslationRepositoryInterface $translationRepository, LanguageRepositoryInterface $languageRepository)
    {
        $this->translationRepository = $translationRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request, $locale)
    {
        $request->validate([
            'key' => 'string|max:255|nullable',
            'group' => 'string|max:255|nullable',
            'text' => 'string|max:1024|nullable',
        ]);
        return view('admin.modules.translation.index', [
            'translations' => $this->translationRepository->getData($request),
            'languages' => $this->translationRepository->getLanguages()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
//    public function create(Request $request)
//    {
//        return view('admin.modules.translation.create', [
//            'languages' => $this->languageRepository->getData($request)
//        ]);
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param \Illuminate\Http\Request $request
//     * @return Application|RedirectResponse|Response|Redirector
//     */
//    public function store(string $locale, TranslationRequest $request)
//    {
//
//        if (!$this->translationRepository->store($request)) {
//            return redirect(route('translationIndex', $locale))->with('danger', trans('admin.translation_not_created'));
//        }
//
//        return redirect(route('translationIndex', $locale))->with('success', trans('admin.translation_success_create'));
//
//    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id, Request $request)
    {
        return view('admin.modules.translation.view', [
            'translation' => $this->translationRepository->find($id),
            'languages' => $this->translationRepository->getLanguages()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id, Request $request)
    {
        return view('admin.modules.translation.update', [
            'translation' => $this->translationRepository->find($id),
            'languages' => $this->translationRepository->getLanguages()
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param LanguageRequest $request
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, Request $request, int $id)
    {

        if (!$this->translationRepository->update($id, $request)) {
            return redirect(route('translationEdit', [$locale, $id]))->with('danger', trans('admin.translation_not_update.'));
        }

        return redirect(route('translationIndex', $locale))->with('success', trans('admin.translation_success_update'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $locale
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(string $locale, int $id)
    {
        if (!$this->translationRepository->delete($id)) {
            return redirect(route('translationIndex', $locale))->with('danger', trans('admin.translation_not_delete'));
        }
        return redirect(route('translationIndex', $locale))->with('success', trans('admin.translation_success_delete'));

    }
}
