<?php

namespace App\Http\Controllers\Banner;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Storage;
use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
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
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $banner = Banner::where('title', 'LIKE', "%$keyword%")
                ->orWhere('banner', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $banner = Banner::paginate($perPage);
            }

            return view('banner.banner.index', compact('banner'));
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
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('banner.banner.create',compact('action'));
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
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'banner' => 'required'
		]);
        try{
            $image = Storage::disk('website')->put('banners', $request->banner);
        }catch(\Exception $e){}//end trycatch.
            $banner                          = new Banner();
            $banner->title                   = $request->title;
            $banner->banner                  = $image ?? "";
            
            $banner->save();
            return redirect('banner/banner')->with('flash_message', 'Banner added!');
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
    public function show(Banner $banner)
    {
        $id = $banner->id;
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $banner = Banner::findOrFail($id);
            return view('banner.banner.show', compact('banner'));
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
    public function edit(Banner $banner)
    {
        $action = 'edit';
        $id = $banner->id;
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $banner = Banner::findOrFail($id);
            return view('banner.banner.edit', compact('banner','action'));
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
    public function update(Request $request, Banner $banner)
    {
        $id = $banner->id;
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'title' => 'required',
			'banner' => 'required'
		]);

        if($request->hasFile('banner')){
                
                $image    = Storage::disk('website')->put('banners', $request->banner);
                $banner = Banner::findOrFail($id);
                $banner->update([
                                    'title'              =>$request->title,
                                    'banner'            =>$image ?? '',
                ]);
        
        }else{
            $banner = Banner::findOrFail($id);
            $banner->update([
                                'title'              =>$request->name,
            ]);
        }
         

             return redirect('banner/banner')->with('flash_message', 'Banner updated!');
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
    public function destroy(Banner $banner)
    {
        $id = $banner->id;
        $model = str_slug('banner','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Banner::destroy($id);

            return redirect('banner/banner')->with('flash_message', 'Banner deleted!');
        }
        return response(view('403'), 403);

    }
}
