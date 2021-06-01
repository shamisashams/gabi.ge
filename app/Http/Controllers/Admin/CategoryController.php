<?php

 namespace App\Http\Controllers\Admin;

 use App\Http\Controllers\Controller;
 use Illuminate\Http\Request;
 use App\Repositories\CategoryRepositoryInterface;

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
     public function index(Request $request, $locale)
     {
	 $categories = $this->categoryRepository->getData($request);
	 
	 dd($categories);
	 return view('admin.modules.category.index', [
	     'categories' => [
		 'category' => 'ASD'
	     ]
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
     public function edit($id)
     {
	 //
     }

     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
	 //
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
 