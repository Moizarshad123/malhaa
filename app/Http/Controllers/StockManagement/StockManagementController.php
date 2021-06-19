<?php

namespace App\Http\Controllers\StockManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Product;
use App\StockManagement;
use Illuminate\Http\Request;

class StockManagementController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('stockmanagement','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $stockmanagement = StockManagement::where('name', 'LIKE', "%$keyword%")
                
                ->paginate($perPage);
            } else {
                $stockmanagement = StockManagement::paginate($perPage);
            }
            $product = Product::where('Status','Trash')->get();
            return view('stockmanagement.stock-management.index', compact('stockmanagement','product'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    // public function create()
    // {
    //     $model = str_slug('stockmanagement','-');
    //     if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
    //         return view('stockmanagement.stock-management.create');
    //     }
    //     return response(view('403'), 403);

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    // public function store(Request $request)
    // {
    //     $model = str_slug('stockmanagement','-');
    //     if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            
    //         $requestData = $request->all();
            
    //         StockManagement::create($requestData);
    //         return redirect('stockmanagement/stock-management')->with('flash_message', 'StockManagement added!');
    //     }
    //     return response(view('403'), 403);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    // public function show(StockManagement $stockmanagement)
    // {
    //     $id = $stockmanagement->id;
    //     $model = str_slug('stockmanagement','-');
    //     if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
    //         $stockmanagement = StockManagement::findOrFail($id);
    //         return view('stockmanagement.stock-management.show', compact('stockmanagement'));
    //     }
    //     return response(view('403'), 403);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Product $stockmanagement)
    {
        $id = $stockmanagement->id;
        $model = str_slug('stockmanagement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $stockmanagement = Product::findOrFail($id);
            return view('stockmanagement.stock-management.edit', compact('stockmanagement'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('stockmanagement','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            
            $stockmanagement = StockManagement::findOrFail($id);
             $stockmanagement->update($requestData);

             return redirect('stockmanagement/stock-management')->with('flash_message', 'StockManagement updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('stockmanagement','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            StockManagement::destroy($id);

            return redirect('stockmanagement/stock-management')->with('flash_message', 'StockManagement deleted!');
        }
        return response(view('403'), 403);

    }
}
