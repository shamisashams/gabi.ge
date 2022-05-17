<?php

namespace App\Http\Controllers\Admin;

use App\Http\Request\Admin\BlogRequest;
use App\Repositories\Eloquent\BlogRepository;
use Illuminate\Http\Request;
use App\Http\Request\Admin\ProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Sale;

class BlogController extends AdminController
{

    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(Request $request, $locale)
    {

        $request->validate([
            'id' => 'integer|nullable',
            'title' => 'string|max:255|nullable',

        ]);
        return view('admin.modules.blog.index', [
            'products' => $this->blogRepository->getData($request, ['availableLanguage'])
        ]);
    }

    public function store(string $lang, BlogRequest $request)
    {
        //dd($request->all());
        if (!$this->blogRepository->store($lang, $request)) {
           // dd(9);
            return redirect(route('blogCreate', $lang))->with('danger', __('admin.product_not_created'));
        }

        return redirect(route('blogIndex', $lang))->with('success', __('admin.product_created_successfully'));
    }

    public function create()
    {
        return view('admin.modules.blog.create');
    }

    public function show(string $lang, int $id)
    {

        return view('admin.modules.blog.view', [
            'productItem' => $this->productRepository->find($id)
        ]);
    }

    public function edit(string $lang, int $id)
    {
        return view('admin.modules.blog.update', [

            'blog' => $this->blogRepository->find($id),

        ]);
    }

    public function update(string $lang, int $id, BlogRequest $request)
    {
        if (!$this->blogRepository->update($lang, $id, $request)) {
            return redirect(route('blogEdit', [$lang, $id]))->with('danger', __('admin.product_not_updated'));
        }

        return redirect(route('blogIndex', $lang))->with('success', __('admin.product_updated_succesfully'));
    }

    public function destroy(string $lang, int $id)
    {
        if (!$this->blogRepository->delete($id)) {
            return redirect(route('blogIndex', $lang))->with('danger', __('admin.product_not_deleted'));
        }
        return redirect(route('blogIndex', $lang))->with('success', __('admin.product_deleted_succesfully'));
    }



}
