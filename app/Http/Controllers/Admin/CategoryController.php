<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepositoryInterface;
use App\Http\Request\Admin\CategoryRequest;

class CategoryController extends AdminController
{

    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',
            'slug' => 'string|max:255|nullable',
            'status' => 'boolean|nullable',
        ]);


        return view('admin.modules.category.index', [
            'categoriesLocal' => $this->categoryRepository->getData($request, ['availableLanguage'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(string $lang, CategoryRequest $request)
    {

        if (!$this->categoryRepository->store($lang, $request)) {
            return redirect(route('categoryCreateView', $lang))->with('danger', __('admin.category_not_created'));
        }

        return redirect(route('categoryIndex', $lang))->with('success', __('admin.category_created_succesfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $lang, int $id)
    {
        return view('admin.modules.category.view', [
            'categoryItem' => $this->categoryRepository->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(string $lang, int $id)
    {
        return view('admin.modules.category.update', [
            'categoryItem' => $this->categoryRepository->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(string $lang, int $id, CategoryRequest $request)
    {

        if (!$this->categoryRepository->update($lang, $id, $request)) {
            return redirect(route('categoryEditView', [$lang, $id]))->with('danger', __('admin.category_not_updated'));
        }

        return redirect(route('categoryIndex', $lang))->with('success', __('admin.category_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $lang, int $id)
    {
        if (!$this->categoryRepository->delete($id)) {
            return redirect(route('categoryIndex', $lang))->with('danger', __('admin.category_not_deleted'));
        }
        return redirect(route('categoryIndex', $lang))->with('success', __('admin.category_deleted_successfully'));
    }

}
