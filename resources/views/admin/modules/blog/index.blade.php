@extends('admin.layouts.app')
@section('content')

<div class="section">
    <div class="row">
	<div class="col s12">
	    <div class="card">
		@include('admin.layouts.alert.alert')
		@include('admin.modules.language-tab.tab')
		<div class="card-content">
		    <a href="{{route('blogCreate',app()->getLocale())}}"
		       class="mb-4 btn waves-effect waves-light green darken-1">{{trans('admin.create_blog')}}</a>
		    <div>
			{!! Form::open(['url' => route('blogIndex',app()->getLocale()),'method' =>'get']) !!}
			<table class="striped">
			    <thead>
                                <tr>
				    <th>@lang('admin.id')</th>
				    <th>@lang('admin.title')</th>
				    <th>@lang('admin.slug')</th>
                                    <th>@lang('admin.status')</th>
				    <th>@lang('admin.date')</th>
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
					{{ Form::text('description',Request::get('description'),  ['class' => 'form-control', 'no','onChange' => 'this.form.submit()']) }}
					@if ($errors->has('description'))
					<span class="help-block">
					    {{ $errors->first('description') }}
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
                                @if(isset($products))
				@foreach($products as $product)
				<tr>
				    <td>{{$product->id}}</td>
				    <td>{{(count($product->availableLanguage) > 0) ?  $product->availableLanguage[0]->title : ''}}</td>
				    <td>{{(count($product->availableLanguage) > 0) ?  $product->availableLanguage[0]->slug : ''}}</td>
				    <td>
					@if($product->status)
					<span
					    class="chip lighten-5 green green-text">{{trans('admin.active')}}</span>
					@else
					<span
					    class="chip lighten-5 red red-text">{{trans('admin.not_active')}}</span>
					@endif
				    </td>
                    <td>{{$product->created_at}}</td>
				    <td>
					<a href="{{route('blogEdit',[app()->getLocale(),$product->id])}}"><i
						class="material-icons">edit</i></a>
					{{--<a href="{{route('blogShow',[app()->getLocale(),$product->id])}}"><i class="material-icons">remove_red_eye</i></a>--}}
					{!! Form::open(['url' => route('blogDestroy',[app()->getLocale(),$product->id]),'method' =>'delete','style'=>'display:inline-block']) !!}
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
			{{ $products->appends(request()->query())->links('admin.vendor.pagination.custom') }}

		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>


@endsection
