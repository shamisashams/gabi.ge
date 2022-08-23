<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\BrandRequest;
use App\Http\Request\Admin\CategoryRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Models\Category;
use App\Models\Localization;
use App\Models\Shipping;
use App\Repositories\Eloquent\ShippingRepository;
use App\Repositories\SliderRepositoryInterface;
use App\Services\CategoryService;
use App\Services\SliderService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class ShippingController extends AdminController
{
    protected $shippingRepository;

    public function __construct(ShippingRepository $shippingRepository)
    {
        $this->shippingRepository = $shippingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     * @param Request $request
     * @return Response
     */
    public function index(string $lang, Request $request)
    {

        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'slug' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);

        return view('admin.modules.shipping.index', [
            'data' => $this->shippingRepository->getData($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param string $locale
     * @return Application|Factory|View|Response
     */
    public function create(string $locale)
    {
        return view('admin.modules.shipping.form', [
            'item' => new Shipping(),
            'method' => 'post',
            'action' => route('shipping.store', app()->getLocale())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required'
        ]);
        if (!$this->shippingRepository->store($locale, $request)) {
            return redirect(route('shipping.create', $locale))->with('danger', trans('admin.slider_not_create'));
        }

        return redirect(route('shipping.index', $locale))->with('success', trans('admin.slider_success_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $slider
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.slider.view', [
            'slider' => $this->shippingRepository->find($id)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $slider
     * @return Application|Factory|View|Response
     */
    public function edit(string $locale, int $id)
    {
        $item = $this->shippingRepository->find($id);
        return view('admin.modules.shipping.form', [
            'item' => $item,
            'method' => 'put',
            'action' => route('shipping.update', [app()->getLocale(), $item])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $locale
     * @param CategoryRequest $request
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(string $locale, Request $request, int $id)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required',
            'price' => 'required'
        ]);
        if (!$this->shippingRepository->update($locale, $id, $request)) {
            return redirect(route('shipping.edit', [$locale, $id]))->with('danger', trans('admin.slider_not_update'));
        }

        return redirect(route('shipping.index', $locale))->with('success', trans('admin.slider_success_update'));
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
        if (!$this->shippingRepository->delete($id)) {
            return redirect(route('shipping.index', $locale))->with('danger', trans('admin.slider_not_delete'));
        }
        return redirect(route('shipping.index', $locale))->with('success', trans('admin.slider_success_delete'));
    }
}
