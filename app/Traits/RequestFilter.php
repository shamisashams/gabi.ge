<?php

 namespace App\Traits;

 use Illuminate\Database\Eloquent\Builder;
 use Illuminate\Http\Request;

 trait RequestFilter
 {

     public function setFiltersFromRequest(Builder $modelQueryBuilder, Request $request)
     {
         if ($request['id']) {
             $modelQueryBuilder->where('id', '=', (int) $request['id']);
         }

         if (false === is_null($request['status'])) {
             $modelQueryBuilder->where('status', '=', (int) $request['status']);
         }

         if ($request['title']) {
             $modelQueryBuilder->whereHas('availableLanguage', function ($query) use ($request) {
                 $query->where('title', 'like', "%{$request['title']}%");
             });
         }

         if ($request['slug']) {
             $modelQueryBuilder->whereHas('availableLanguage', function ($query) use ($request) {
                 $query->where('slug', 'like', "%{$request['slug']}%");
             });
         }

         if ($request['description']) {
             $modelQueryBuilder->whereHas('availableLanguage', function ($query) use ($request) {
                 $query->where('description', 'like', "%{$request['description']}%");
             });
         }

         return $modelQueryBuilder;
     }

 }
 