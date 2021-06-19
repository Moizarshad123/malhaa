@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Stockmanagement</h3>
                    {{-- @can('add-'.str_slug('StockManagement'))
                        <a class="btn btn-success pull-right" href="{{ url('/stockmanagement/stock-management/create') }}"><i
                                    class="icon-plus"></i> Add Stockmanagement</a>
                    @endcan --}}
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $item)
                                <tr>
                                    
                                  
                                    <form action="/stockmanagement/stock-management/ " method="post">
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td><div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                                            <label for="product_name" class="col-md-4 control-label">{{ 'Product' }}</label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="product_name" type="text" id="product_name" value="{{ $stockmanagement->product_name?? ''}}" >
                                                {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div>--}}
                                    {{ $item->product_name }}
                                    </td> 
                                        <td>  <div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
                                            <label for="stock" class="col-md-4 control-label">{{ 'Product Stock' }}</label>
                                            <div class="col-md-6">
                                                <input class="form-control" name="stock" type="text" id="stock" value="{{ $stockmanagement->stock?? ''}}" >
                                                {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
                                            </div>
                                        </div></td>
                                        <td><div class="form-group">
                                            <div class="col-md-offset-4 col-md-4">
                                                <input class="btn btn-primary" type="submit" value="{{ $submitButtonText?? 'Create' }}">
                                            </div>
                                        </div></td>

                                    </form>
                                    
                                    
                               

                                    {{-- <td> --}}
                                        {{-- @can('edit-'.str_slug('StockManagement'))
                                            {{-- <a href="{{ url('/stockmanagement/stock-management/' . $item->id . '/edit') }}"
                                               title="Edit StockManagement">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a> --}}
                                        {{-- @endcan  --}}

                                    {{-- </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $stockmanagement->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>

@endpush
