@extends('admin.layouts.app')
@section('content')
<div class="section">
    <div class="row">
	<div class="col s12">
	    <div class="container">
		<?php
		 //  dd($categoryItem->availableLanguage);
		?>
		<!-- users view start -->
		<div class="section users-view">
		    <div class="card">
			<div class="card-content">
			    <div class="row">
				<div class="col s12 m4">
				    <table class="striped">
					<tbody>
                                            <tr>
                                                <td>{{trans('admin.title')}}:</td>
                                                <td>{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->title : ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.description')}}:</td>
                                                <td class="users-view-latest-activity">{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->description : ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.slug')}}:</td>
                                                <td class="users-view-verified">{{(count($categoryItem->availableLanguage) > 0) ?  $categoryItem->availableLanguage[0]->slug : ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.parent_id')}}:</td>
                                                <td class="users-view-role">{{$categoryItem->parent_id}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td>
                                                    @if($categoryItem->status)
						    <span
							class="users-view-status chip green lighten-5 green-text">{{trans('admin.active')}}</span>
                                                    @else
						    <span
							class="users-view-status chip red lighten-5 red-text">{{trans('admin.not_active')}}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>

                                            </tr>
					</tbody>
				    </table>
				</div>
			    </div>
			</div>
		    </div>

		</div>

	    </div>
	</div>
	<div class="content-overlay"></div>
    </div>
</div>
@endsection
