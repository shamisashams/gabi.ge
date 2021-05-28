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

    public function __construct(TranslationRepositoryInterface $translationRepository,LanguageRepositoryInterface $languageRepository)
    {
        $this->translationRepository = $translationRepository;
        $this->languageRepository = $languageRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index(Request $request, $locale)
    {
        return view('admin.modules.translation.index', [
            'translations' => $this->translationRepository->getData($request),
            'languages'=>$this->languageRepository->getData($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.modules.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, LanguageRequest $request)
    {

        if (!$this->languageRepository->store($request)) {
            return redirect(route('languageEditView', $locale))->with('danger', 'Language does not created.');
        }

        return redirect(route('languageIndex', $locale))->with('success', 'Language was successfully created.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.language.view', [
            'language' => $this->languageRepository->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id,Request $request)
    {
        return view('admin.modules.translation.update', [
            'translation' => $this->translationRepository->find($id),
            'languages'=>$this->languageRepository->getData($request)
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
            return redirect(route('translationEdit', $locale))->with('danger', trans('admin.Translation does not update.'));
        }

        return redirect(route('translationIndex', $locale))->with('success',trans('admin.translation_success_update') );

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
        if (!$this->languageRepository->delete($id)) {
            return redirect(route('languageIndex', $locale))->with('danger', 'Language is default.');
        }
        return redirect(route('languageIndex', $locale))->with('success', 'Language delete successfully.');

    }
}
