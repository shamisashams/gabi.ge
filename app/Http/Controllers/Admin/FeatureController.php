<?php
/**
 *  app/Http/Controllers/Admin/FeatureController.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:07
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\FeatureRequest;
use App\Repositories\FeatureRepositoryInterface;
use App\Services\FeatureService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class FeatureController extends AdminController
{
    protected $featureRepository;

    public function __construct(FeatureRepositoryInterface $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }


    /**
     * Display a listing of the resource.
     * @param string $lang
     * @return Application|Factory|View|Response
     */
    public function index(string $lang, Request $request)
    {
        return view('admin.modules.feature.index', [
            'features' => $this->featureRepository->getData($request, ['availableLanguage']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.modules.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $lang
     * @param FeatureRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, FeatureRequest $request)
    {

        if (!$this->featureRepository->store($locale, $request)) {
            return redirect(route('featureIndex', $locale))->with('danger', __('admin.feature_not_created'));
        }

        return redirect(route('featureIndex', $locale))->with('success', __('admin.feature_success_create'));

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
        return view('admin.modules.feature.view', [
            'feature' => $this->featureRepository->find($id)
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
        return view('admin.modules.feature.update', [
            'feature' => $this->featureRepository->find($id)
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
    public function update(string $locale, FeatureRequest $request, int $id)
    {

        if (!$this->featureRepository->update($locale, $id, $request)) {
            return redirect(route('featureIndex', $locale))->with('danger', __('admin.feature_not_updated'));
        }

        return redirect(route('featureIndex', $locale))->with('success', __('admin.feature.success.update'));

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
        if (!$this->featureRepository->delete($id)) {
            return redirect(route('featureIndex', $locale))->with('danger', __('admin.feature_not_deleted'));
        }
        return redirect(route('featureIndex', $locale))->with('success', __('admin.feature_success_delete'));

    }
}
