<?php
/**
 *  app/Http/Controllers/Admin/PageController.php
 *
 * User:
 * Date-Time: 18.12.20
 * Time: 11:06
 * @author Vito Makhatadze <vitomaxatadze@gmail.com>
 */

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\FeatureRequest;
use App\Http\Request\Admin\PageRequest;
use App\Http\Request\Admin\SaleRequest;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\SaleRepositoryInterface;
use App\Services\PageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class SaleController extends AdminController
{
    protected $saleRepository;

    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
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
            'discount' => 'string|max:255|nullable',
            'type' => 'string|max:255|nullable',
            'title' => 'string|max:255|nullable',
        ]);
        return view('admin.modules.sale.index', [
            'sales' => $this->saleRepository->getData($request, ['availableLanguage'])
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create(string $locale)
    {
//        return redirect(route('pageIndex', $locale));
        return view('admin.modules.sale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $lang
     * @param FeatureRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, SaleRequest $request)
    {
        if (!$this->saleRepository->store($locale, $request)) {
            return redirect(route('saleIndex', $locale))->with('danger', trans('admin.sale_not_created'));
        }

        return redirect(route('saleIndex', $locale))->with('success', trans('admin.sale_success_create'));

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
        return view('admin.modules.sale.view', [
            'sale' => $this->saleRepository->find($id)
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
        return view('admin.modules.sale.update', [
            'sale' => $this->saleRepository->find($id)
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
    public function update(string $locale, SaleRequest $request, int $id)
    {

        if (!$this->saleRepository->update($locale, $id, $request)) {
            return redirect(route('saleEditView', [$locale, $id]))->with('danger', __('admin.sale_not_update'));
        }

        return redirect(route('saleIndex', $locale))->with('success', __('admin.sale.success_update'));

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
        if (!$this->saleRepository->delete($id)) {
            return redirect(route('saleIndex', $locale))->with('danger', trans('sale_not_delete'));
        }
        return redirect(route('saleIndex', $locale))->with('success', trans('admin.sale_success_delete'));

    }
}
