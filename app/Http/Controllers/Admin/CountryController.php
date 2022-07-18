<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\BrandRequest;
use App\Http\Request\Admin\CategoryRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\Localization;
use App\Models\Shipping;
use App\Repositories\Eloquent\CountryRepository;
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

class CountryController extends AdminController
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
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

        return view('admin.modules.country.index', [
            'data' => $this->countryRepository->getData($request),
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
        return view('admin.modules.country.form',[
            'item' => new Country(),
            'method' => 'post',
            'action' => route('country.store',app()->getLocale())
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
        //dd($request->all());
        $request->validate([
            'code' => 'nullable',
        ]);
        if (!$this->countryRepository->store($locale, $request)) {
            return redirect(route('country.create', $locale))->with('danger', trans('admin.slider_not_create'));
        }

        return redirect(route('country.index', $locale))->with('success', trans('admin.slider_success_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $slider
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.country.view', [
            'slider' => $this->countryRepository->find($id)
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
        $item = $this->countryRepository->find($id);
        return view('admin.modules.country.form', [
            'item' => $item,
            'method' => 'put',
            'action' => route('country.update',[app()->getLocale(),$item])
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
            'code' => 'nullable'
        ]);
        if (!$this->countryRepository->update($locale, $id, $request)) {
            return redirect(route('country.edit', [$locale, $id]))->with('danger', trans('admin.slider_not_update'));
        }

        return redirect(route('country.index', $locale))->with('success', trans('admin.slider_success_update'));

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
        if (!$this->countryRepository->delete($id)) {
            return redirect(route('country.index', $locale))->with('danger', trans('admin.slider_not_delete'));
        }
        return redirect(route('country.index', $locale))->with('success', trans('admin.slider_success_delete'));

    }
}
