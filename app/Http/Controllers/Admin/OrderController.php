<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\Admin\CategoryRequest;
use App\Http\Request\Admin\OrderRequest;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\UserAdminRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     * @param Request $request
     * @return View
     */
    public function index(string $lang, OrderRequest $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'slug' => 'string|max:255|nullable',
            'status' => 'nullable',
        ]);
//        dd($this->orderRepository->getData($request));

        return view('admin.modules.order.index', [
            'orders' => $this->orderRepository->getData($request, ["products" => function ($query){
                $query->with(["product" => function($query) {
                    $query->with("availableLanguage");
                }]);
            }]),
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
        return view('admin.modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(string $locale, OrderRequest $request)
    {

        if (!$this->orderRepository->store($locale, $request)) {
            return redirect(route('userCreateView', $locale))->with('danger', trans('admin.user_not_create'));
        }

        return redirect(route('userIndex', $locale))->with('success', trans('admin.user_success_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $slider
     * @return Application|Factory|View|Response
     */
    public function show(string $locale, int $id)
    {
        return view('admin.modules.order.view', [
            'order' => $this->orderRepository->findData($id, ["products" => function ($query){
                $query->with(["product" => function($query) {
                    $query->with(["availableLanguage"]);
                }]);
            }])
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
        return view('admin.modules.order.update', [
            'user' => $this->orderRepository->find($id)
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
    public function update(string $locale, OrderRequest $request, int $id)
    {
        if (!$this->orderRepository->update($locale, $id, $request)) {
            return redirect(route('orderEditView', [$locale, $id]))->with('danger', trans('admin.user_not_update'));
        }

        return redirect(route('orderIndex', $locale))->with('success', trans('admin.user_success_update'));

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
        if (!$this->orderRepository->delete($id)) {
            return redirect(route('orderIndex', $locale))->with('danger', trans('admin.user_not_delete'));
        }
        return redirect(route('orderIndex', $locale))->with('success', trans('admin.user_success_delete'));

    }
}
