<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\AdminUserRequest;
use App\Http\Request\Admin\BrandRequest;
use App\Http\Request\Admin\CategoryRequest;
use App\Http\Request\Admin\SliderRequest;
use App\Models\Category;
use App\Models\Localization;
use App\Repositories\Eloquent\UserAdminRepository;
use App\Repositories\Frontend\UserRepositoryInterface;
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

class UserController extends AdminController
{
    protected $userRepository;

    public function __construct(UserAdminRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param string $lang
     * @param Request $request
     * @return View
     */
    public function index(string $lang, AdminUserRequest $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'slug' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);

        return view('admin.modules.user.index', [
            'users' => $this->userRepository->getData($request),
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
    public function store(string $locale, AdminUserRequest $request)
    {

        if (!$this->userRepository->store($locale, $request)) {
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
        return view('admin.modules.user.view', [
            'user' => $this->userRepository->find($id)
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
        return view('admin.modules.user.update', [
            'user' => $this->userRepository->find($id)
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
    public function update(string $locale, AdminUserRequest $request, int $id)
    {
        if (!$this->userRepository->update($locale, $id, $request)) {
            return redirect(route('userEditView', [$locale, $id]))->with('danger', trans('admin.user_not_update'));
        }

        return redirect(route('userIndex', $locale))->with('success', trans('admin.user_success_update'));

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
        if (!$this->userRepository->delete($id)) {
            return redirect(route('userIndex', $locale))->with('danger', trans('admin.user_not_delete'));
        }
        return redirect(route('userIndex', $locale))->with('success', trans('admin.user_success_delete'));

    }
}
