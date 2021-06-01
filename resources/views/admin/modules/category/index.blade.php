@extends('admin.layouts.app')
@section('content')
<div class="section">
    <div class="row">
	<div class="col s12">
	    <div class="card">
		@include('admin.layouts.alert.alert')
		<div class="card-content">
		    <a href="{{route('categoryCreateView',app()->getLocale())}}"
		       class="mb-4 btn waves-effect waves-light green darken-1">{{trans('admin.create_language')}}</a>
		    <div style="overflow: auto">
			{!! Form::open(['url' => route('categoryIndex',app()->getLocale()),'method' =>'get']) !!}
			<table class="striped">
			    <thead>
                                <tr>
				    <th>@lang('admin.id')</th>
				    <th>@lang('admin.title')</th>
				    <th>@lang('admin.slug')</th>
				    <th>@lang('admin.status')</th>
				    <th>@lang('admin.actions')</th>
                                </tr>
                                <tr>
				    <th>
					{{ Form::text('id',Request::get('id'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
					@if ($errors->has('id'))
					<span class="help-block">
					    {{ $errors->first('id') }}
					</span>
					@endif
				    </th>
				    <th>
					{{ Form::text('title',Request::get('title'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
					@if ($errors->has('title'))
					<span class="help-block">
					    {{ $errors->first('title') }}
					</span>
					@endif
				    </th>
				    <th>
					{{ Form::text('slug',Request::get('slug'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
					@if ($errors->has('slug'))
					<span class="help-block">
					    {{ $errors->first('slug') }}
					</span>
					@endif
				    </th>
				    <th>
					{{ Form::select('status',['' => 'All','1' => 'Active','0' => 'Not Active'],Request::get('status'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
					@if ($errors->has('status'))
					<span class="help-block">
					    {{ $errors->first('status') }}
					</span>
					@endif
				    </th>
				    <th></th>
                                </tr>
			    </thead>
			    {!! Form::close() !!}

			    <tbody>
                                @if(isset($categoriesLocal))
				@foreach($categoriesLocal as $category)
				<tr>
				    <td>{{$category->id}}</td>
				    <td>{{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->title : ''}}</td>
				    <td>{{(count($category->availableLanguage) > 0) ?  $category->availableLanguage[0]->slug : ''}}</td>
				    <td>
					@if($category->status)
					<span
					    class="chip lighten-5 green green-text">{{trans('admin.active')}}</span>
					@else
					<span
					    class="chip lighten-5 red red-text">{{trans('admin.not_active')}}</span>
					@endif
				    </td>
				    <td>
					<a href="{{route('categoryEditView',[app()->getLocale(),$category->id])}}"><i
						class="material-icons">edit</i></a>
					<a href="{{route('categoryShow',[app()->getLocale(),$category->id])}}"><i class="material-icons">remove_red_eye</i></a>
					{!! Form::open(['url' => route('categoryDestroy',[app()->getLocale(),$category->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
					<a onclick="deleteAlert(this, 'Are you sure, you want to delete this item?!');"
					   type="submit">
					    <i class="material-icons dp48">delete</i>
					</a>
					{!! Form::close() !!}
				    </td>
				</tr>
				@endforeach
                                @endif
			    </tbody>
			</table>
			{{ $categoriesLocal->links('admin.vendor.pagination.custom') }}

		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>


@endsection
