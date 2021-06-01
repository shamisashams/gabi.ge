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
      *
      * @return Application|Factory|View|Response
      */
     public function index(Request $request)
     {
	 $categories = $this->categoryRepository->getData($request, 'availableLanguage');

	 return view('admin.modules.category.index', [
	     'categoriesLocal' => $categories
	 ]);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
	 //
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
	 //
     }

     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
	 //
     }

     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit(string $locale, int $id)
     {
	 var_dump($locale, $id);
	 return view('admin.modules.category.update', [
	     'categoryItem' => $this->categoryRepository->find($id)
	 ]);
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(CategoryRequest $request, $id)
     {
	 var_dump($id);
	 dd($request);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
	 //
     }

 }
 