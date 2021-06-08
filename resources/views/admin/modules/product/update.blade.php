@extends('admin.layouts.app')
@section('content')
<div class="section">
    <?php
    ?>
    <div class="row">
	<div class="col s12">
	    <div class="container">
		<!-- users edit start -->
		<div class="section users-edit">
		    <div class="card">
			<div class="card-content">
			    <div class="row">
				<div class="col s12 active" id="account">
				    <!-- users edit media object ends -->
				    <!-- users edit account form start -->
				    <form id="accountForm" novalidate="novalidate"
					  action="{{route('productUpdate',[app()->getLocale(),$productItem->id])}}"
					  method="POST">
					{{ method_field('PUT') }}
					@csrf
					<div class="row">
					    <div class="col s12 m6">
						<div class="row">
						    <div class="col s12 input-field">
							<input id="title" name="title" type="text"
							       class="validate {{ $errors->has('title') ? 'invalid' : 'valid' }}"
							       value="{{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->title : ''}}"
							       data-error=".errorTxt">
							<label for="id"
							       class="active">{{trans('admin.title')}}</label>
							@if ($errors->has('title'))
							<small
							    class="errorTxt">{{ $errors->first('title') }}</small>
							@endif

						    </div>
						    <div class="col s12 input-field">
							<input id="slug" name="slug" type="text"
							       class="validate {{ $errors->has('slug') ? 'invalid' : 'valid' }}"
							       value="{{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->slug : ''}}"
							       data-error=".errorTxt">
							<label for="slug"
							       class="active">{{trans('admin.slug')}}</label>
							@if ($errors->has('slug'))
							<small
							    class="errorTxt">{{ $errors->first('slug') }}</small>
							@endif
						    </div>


						    <div class="col s12 input-field">
							<input id="price" name="price" type="number"
							       class="validate {{ $errors->has('price') ? 'invalid' : 'valid' }}"
							       value="{{$productItem->price}}"
							       data-error=".errorTxt">
							<label for="description"
							       class="active">{{trans('admin.price')}}</label>
							@if ($errors->has('category_id'))
							<small
							    class="errorTxt">{{ $errors->first('price') }}</small>
							@endif
						    </div>
						</div>
					    </div>
					    <div class="col s12 m6">
						<div class="row">
						    <div class="col s12 input-field">
							<input id="description" name="description" type="text"
							       class="validate {{ $errors->has('description') ? 'invalid' : 'valid' }}"
							       value="{{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->description : ''}}"
							       data-error=".errorTxt">
							<label for="description"
							       class="active">{{trans('admin.description')}}</label>
							@if ($errors->has('description'))
							<small
							    class="errorTxt">{{ $errors->first('description') }}</small>
							@endif
						    </div>

						    <div class="col s12 input-field">
							<input id="position" name="position" type="number"
							       class="validate {{ $errors->has('position') ? 'invalid' : 'valid' }}"
							       value="{{$productItem->position}}"
							       data-error=".errorTxt">
							<label for="description"
							       class="active">{{trans('admin.position')}}</label>
							@if ($errors->has('position'))
							<small
							    class="errorTxt">{{ $errors->first('position') }}</small>
							@endif
						    </div>

						    <div class="col s12 input-field">

							<select name="category_id" class="select2 browser-default">
							    <option value="" disabled selected>Choose your option
							    </option>
							    @foreach($categories as $category):

							    <option {{ $productItem->category->id ==  $category->id   ?   "selected":""}} value="{{$category->id}}">{{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}</option>
							    @endforeach

							</select>
							<label for="category_id" class="">{{trans('admin.category_id')}}</label>
							@if ($errors->has('category_id'))
							<small
							    class="errorTxt">{{ $errors->first('category_id') }}</small>
							@endif

						    </div>


						    <div class="col s12 input-field">


							<textarea id="short_description" name="short_description" 
								  class="validate {{ $errors->has('short_description') ? 'invalid' : 'valid' }}"
								  data-error=".errorTxt">  {{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->short_description : ''}} </textarea>
							<label for="short_description"
							       class="active">{{trans('admin.short_description')}}</label>
							@if ($errors->has('short_description'))
							<small
							    class="errorTxt">{{ $errors->first('short_description') }}</small>
							@endif
						    </div>

						</div>
					    </div>
					    <div class="col s12">

						<label>
						    <input type="checkbox" {{$productItem->status ? 'checked' : '' }} name="status">
						    <span>{{trans('admin.status')}}</span>
						</label>
					    </div>
					    <div class="col s12 display-flex justify-content-end mt-3">
						<button type="submit" class="btn indigo">
						    {{trans('admin.update')}}
						</button>
					    </div>
					</div>
				    </form>
				    <!-- users edit account form ends -->
				</div>
			    </div>
			    <!-- </div> -->
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<div class="content-overlay"></div>
    </div>
</div>
@endsection
