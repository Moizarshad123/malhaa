<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Storage;
use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $brand = Brand::where('name', 'LIKE', "%$keyword%")
                ->orWhere('logo', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $brand = Brand::paginate($perPage);
            }

            return view('brand.brand.index', compact('brand'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $action = 'add';
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('brand.brand.create',compact('action'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'logo' => 'required'
		]);
        try{
            $image = Storage::disk('website')->put('brands', $request->logo);
        }catch(\Exception $e){}//end trycatch.

            $brand                          = new Brand();
            $brand->name                    = $request->name;
            $brand->logo                    = $image ?? "";
            
            $brand->save();
            return redirect('brand/brand')->with('flash_message', 'Brand added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Brand $brand)
    {
        $id = $brand->id;
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $brand = Brand::findOrFail($id);
            return view('brand.brand.show', compact('brand'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Brand $brand)
    {
        $action = 'edit';
        $id = $brand->id;
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $brand = Brand::findOrFail($id);
            return view('brand.brand.edit', compact('brand','action'));
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
    public function update(Request $request, Brand $brand)
    {
        $id = $brand->id;
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'logo' => 'required'
		]);
            
        if($request->hasFile('logo')){
            
                $image    = Storage::disk('website')->put('brands', $request->logo);
                $brand = Brand::findOrFail($id);
                $brand->update([
                                    'name'              =>$request->name,
                                    'logo'            =>$image ?? '',
                ]);
            
        }else{
            $brand = Brand::findOrFail($id);
            $brand->update([
                                'name'              =>$request->name,
            ]);
        }

             return redirect('brand/brand')->with('flash_message', 'Brand updated!');
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
    public function destroy(Brand $brand)
    {
        $id = $brand->id;
        $model = str_slug('brand','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Brand::destroy($id);

            return redirect('brand/brand')->with('flash_message', 'Brand deleted!');
        }
        return response(view('403'), 403);

    }
}
