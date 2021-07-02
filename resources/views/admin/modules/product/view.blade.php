@extends('admin.layouts.app')
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div class="container">
                <?php
                //  dd($productItem->availableLanguage);
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
                                                <td>{{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->title : ''}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('admin.short_description')}}:</td>
                                                <td class="users-view-latest-activity">{{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->short_description : ''}}</td>
                                            </tr>


                                            <tr>
                                                <td>{{trans('admin.description')}}:</td>
                                                <td class="users-view-latest-activity">{{(count($productItem->availableLanguage) > 0) ?  $productItem->availableLanguage[0]->description : ''}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('admin.catgegory')}}:</td>
                                                <td class="users-view-verified">{{(count($productItem->category->availableLanguage) > 0) ?  $productItem->category->availableLanguage[0]->title : ''}}</td>
                                            </tr>

                                            <tr>
                                                <td>{{trans('admin.price')}}:</td>
                                                <td class="users-view-verified">{{$productItem->price/100}} $</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.sale_price')}}:</td>
                                                @if($productItem->saleProduct && $productItem->saleProduct->sale)
                                                    <td class="users-view-verified">
                                                        {{\App\Models\Product::calculatePrice($productItem->price,$productItem->saleProduct->sale->discount,$productItem->saleProduct->sale->type)}}
                                                        $
                                                    </td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.weight')}}:</td>
                                                <td class="users-view-verified">{{$productItem->weight}}</td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('admin.status')}}:</td>
                                                <td>
                                                    @if($productItem->status)
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

                                <div style="display: flex;flex-wrap:wrap;">
                                    @if(count($productItem->files)>0)
                                        @foreach($productItem->files as $productFile)
                                            <div class="flex-image">
                                                <img
                                                    src="/storage/product/{{$productFile->fileable_id}}/{{$productFile->name}}"
                                                    class="page-image"/>
                                            </div>
                                        @endforeach
                                    @endif
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
