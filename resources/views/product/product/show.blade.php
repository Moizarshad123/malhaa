@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Product {{ $product->id }}</h3>
                    @can('view-'.str_slug('Product'))
                        <a class="btn btn-success pull-right" href="{{ url('/product/product') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr><th> Categories </th><td> {{ $category->name??"" }} </td></tr>
                            <tr><th> Product Name </th><td> {{ $product->product_name??"" }} </td></tr>
                            <tr><th> Brand </th><td> {{ $product->brand??"" }} </td></tr>
                            <tr><th> Regular Price </th><td> {{ $product->regular_price??"" }} </td></tr>
                            @if($product->sale_price??"")
                            <tr><th> Sale Price </th><td> {{ $product->sale_price??"" }} </td></tr>
                            <tr><th> Sale Price Starting Date </th><td> {{ $product->sale_price_start_date_time??"" }} </td></tr>
                            <tr><th> Sale Price Ending Date </th><td> {{ $product->sale_price_end_date_time??"" }} </td></tr>
                            @endif
                            <tr><th> Main Image </th><td><img src="{{asset('website/'. $product->main_image ?? '')}}" style="width: 70px;height: 70px"> </td></tr>
                            <tr><th> Multi Image </th><td>
                              @if($multiImages != null )      
                                @foreach ($multiImages as $item)
                                <img src="{{asset('website/products/multi/'.$item ?? '')}}" style="width: 70px;height: 70px"> 
                                @endforeach
                              @endif
                            </td></tr>
                            <tr><th> Short Description </th><td> {{ $product->short_description??"" }} </td></tr>
                            <tr><th> Long Description </th><td> {{ $product->long_description??"" }} </td></tr>
                            <tr><th> Color </th><td> 
                                @if($col != null)
                                @foreach ($col as $item)
                                    <span style = "color:{{ $item }}">{{ $item }},</span> 
                                    @endforeach
                                @endif
                                </td></tr>
                            <tr><th> Tags </th><td> {{ $product->tags??"" }} </td></tr>
                            <tr><th> Stock </th><td> {{ $product->stock??"" }} </td></tr>
                            <tr><th> Stock Status </th><td> {{ $product->stock_status??"" }} </td></tr>
                            <tr><th> Status </th><td> {{ $product->status??"" }} </td></tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

