@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Coupon {{ $coupon->id }}</h3>
                    @can('view-'.str_slug('Coupon'))
                        <a class="btn btn-success pull-right" href="{{ url('/coupon/coupon') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr><th> Coupon Code </th><td> {{ $coupon->coupon_code }} </td></tr>
                            <tr><th> Coupon Start Date Time </th><td> {{ $coupon->coupon_start_date_time }} </td></tr>
                            <tr><th> Coupon End Date Time </th><td> {{ $coupon->coupon_end_date_time }} </td></tr>
                            <tr><th> Coupon Type </th><td> {{ $coupon->coupon_type }} </td></tr>
                            <tr><th> Coupon Amount </th><td> {{ $coupon->amount }} </td></tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

