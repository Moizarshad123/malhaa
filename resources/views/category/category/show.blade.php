@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Category {{ $category->id }}</h3>
                    @can('view-'.str_slug('Category'))
                        <a class="btn btn-success pull-right" href="{{ url('/category/category') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $category->name }} </td></tr><tr><th> Banner </th><td><img src="{{asset('website/' . $category->banner)}}" style="width: 70px;height: 70px"></td></tr><tr><th> Url Name </th><td> {{ $category->url_name }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

