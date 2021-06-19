<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Storage;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $category = Category::where('name', 'LIKE', "%$keyword%")
                ->orWhere('banner', 'LIKE', "%$keyword%")
                ->orWhere('url_name', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $category = Category::paginate($perPage);
            }

            return view('category.category.index', compact('category'));
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('category.category.create',compact('action'));
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
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'banner' => 'required',
			'url_name' => 'required',
			'status' => 'required'
		]);
            try{
                $image = Storage::disk('website')->put('categories', $request->banner);
            }catch(\Exception $e){}//end trycatch.

            $category                       = new Category();
            $category->name                 = $request->name;
            $category->url_name             = $request->url_name;
            $category->banner               = $image??"";
            $category->status               = $request->status;
            $category->save();
            return redirect('category/category')->with('message', 'Category added!');
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
    public function show(Category $category)
    {
        $id = $category->id;
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $category = Category::findOrFail($id);
            return view('category.category.show', compact('category'));
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
    public function edit(Category $category)
    {
        $action = 'edit';
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $id = $category->id;
            $category = Category::findOrFail($id);
            return view('category.category.edit', compact('category','action'));
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
    public function update(Request $request, Category $category)
    {
        // dd($category);
        $id = $category->id;
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'name' => 'required',
			'banner' => 'required',
			'url_name' => 'required',
			'status' => 'required'
		]);
            // $requestData = $request->all();
            
            // $category = Category::findOrFail($id);
            //  $category->update($requestData);
            if($request->hasFile('banner')){
                // try{
                    $image    = Storage::disk('website')->put('categories', $request->banner);
                    $category = Category::findOrFail($id);
                    $category->update([
                                        // 'level_name'        =>$request->level_name,
                                        'name'              =>$request->name,
                                        'url_name'          =>$request->url_name,
                                        // 'description'       =>$request->description,
                                        'banner'            =>$image,
                                        'status'            =>$request->status,
                    ]);
                // }catch(\Exception $e){}//end trycatch.
            }else{
                $category = Category::findOrFail($id);
                $category->update([
                                    // 'level_name'        =>$request->level_name,
                                    'name'              =>$request->name,
                                    'url_name'          =>$request->url_name,
                                    // 'description'       =>$request->description,
                                    // 'banner'            =>$image,
                                    'status'            =>$request->status,
                ]);
            }

             return redirect('category/category')->with('message', 'Category updated!');
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
    public function destroy(Category $category)
    {
        
        $id = $category->id;
        $model = str_slug('category','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Category::destroy($id);

            return redirect('category/category')->with('message', 'Category deleted!');
        }
        return response(view('403'), 403);

    }
}
