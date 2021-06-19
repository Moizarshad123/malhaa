<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Storage;
use DB;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $product = Product::where('categories', 'LIKE', "%$keyword%")
                ->orWhere('product_name', 'LIKE', "%$keyword%")
                ->orWhere('regular_price', 'LIKE', "%$keyword%")
                ->orWhere('sale_price', 'LIKE', "%$keyword%")
                ->orWhere('short_description', 'LIKE', "%$keyword%")
                ->orWhere('long_description', 'LIKE', "%$keyword%")
                ->orWhere('color', 'LIKE', "%$keyword%")
                ->orWhere('size', 'LIKE', "%$keyword%")
                ->orWhere('main_image', 'LIKE', "%$keyword%")
                ->orWhere('multi_image', 'LIKE', "%$keyword%")
                ->orWhere('tags', 'LIKE', "%$keyword%")
                ->orWhere('stock', 'LIKE', "%$keyword%")
                ->orWhere('sku_code', 'LIKE', "%$keyword%")
                ->orWhere('manage_stock', 'LIKE', "%$keyword%")
                ->orWhere('stock_status', 'LIKE', "%$keyword%")
                ->orWhere('solid_individually', 'LIKE', "%$keyword%")
                ->orWhere('weight', 'LIKE', "%$keyword%")
                ->orWhere('is_featured', 'LIKE', "%$keyword%")
                ->orWhere('brand', 'LIKE', "%$keyword%")
                ->orWhere('related_products', 'LIKE', "%$keyword%")
                ->orWhere('sale_price_start_date_time', 'LIKE', "%$keyword%")
                ->orWhere('sale_price_end_date_time', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $product = Product::paginate($perPage);
            }
            return view('product.product.index', compact('product'));
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
        $categories = Category::all();

        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('product.product.create',compact('action','categories'));
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


        
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			// 'categories' => 'required',
			// 'product_name' => 'required',
			// 'regular_price' => 'required',
			// 'main_image' => 'required',
			// 'multi_image' => 'required',
			// 'tags' => 'required',
			// 'stock' => 'required',
			// 'sku_code' => 'required',
			// 'stock_status' => 'required'
		]);
        $product                                   =new Product();     
        try{
            $main_image = Storage::disk('website')->put('products/main', $request->main_image);
        }catch(\Exception $e){}//end trycatch.

            if($request->hasfile('multi_image')){
                $last_row = DB::table('products')->latest()->first();
                if($last_row != null){
                    $last_id = ($last_row->id)+1;
                }else{
                    $last_id = 0;
                }
                $no          = 1;
                foreach($request->file('multi_image') as $img){
                    $logo    =  "product_".($last_id)."_".$no.".".$img->extension();
                    $img->move(public_path('website/products/multi'), $logo);
                    $data[]  =$logo;
                    $no++;
                }
            }
            $product->multi_image                 =json_encode($data??'',true,JSON_UNESCAPED_SLASHES);
            $product->main_image                  =$main_image ?? "";
            $product->categories                  =$request->categories;
            $product->product_name                =$request->product_name;
            $product->regular_price               =$request->regular_price;
            $product->sale_price                  =$request->sale_price;
            $product->short_description           =$request->short_description;
            $product->long_description            =$request->long_description;
            if($request->has('color')){
                foreach($request->color as $colors){
                    $savecolors[] = $colors;
                }
            }
            $product->color                       =json_encode($savecolors);
            $tags                    = array();
            if($request->tags[0] != null){
                foreach (json_decode($request->tags[0]) as $key => $tag) {
                    array_push($tags, $tag->value);
                }
            }
            $product->tags                        = implode(',', $tags);
           
            $size                    = array();
            if($request->size[0] != null){
                foreach (json_decode($request->size[0]) as $key => $siz) {
                    array_push($size, $siz->value);
                }
            }
            $product->size                        = implode(',',$size);
            $product->stock                       =$request->stock;
            $product->sku_code                    =$request->sku_code;
            $product->manage_stock                =$request->manage_stock;
            $product->stock_status                =$request->stock_status;
            $product->status                      =$request->status;
            $product->is_featured                 =$request->is_featured;
            $product->brand                       =$request->brand;
            $product->related_products            =$request->related_products;
            $product->sale_price_start_date_time  =$request->sale_price_start_date_time;
            $product->sale_price_end_date_time    =$request->sale_price_end_date_time;
            $product->save();

            
            
            // $request->main_image->move(public_path('website/products/main'), $logo);
        
            return redirect('product/product')->with('flash_message', 'Product added!');
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
    public function show(Product $product)
    {
        $id = $product->id;
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $product = Product::findOrFail($id);
            $category = Category::where('id',$product->categories)->first();
            $multiImages = json_decode($product->multi_image);
            $col = json_decode($product->color);
            return view('product.product.show', compact('product','multiImages','col','category'));
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
    public function edit(Product $product)
    {
        $action = 'edit';
        $id    = $product->id; 
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $product = Product::findOrFail($id);
            $multiImages = json_decode($product->multi_image);
            $categories = Category::where('id',$product->categories)->get();
            $tags = json_decode($product->tags);
            $size = json_decode($product->size);
          
            // dd($product->stock_status); 
            return view('product.product.edit', compact('product','action','categories','multiImages','tags','size'));
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
    public function update(Request $request,Product $product)
    {
        $id = $product->id;
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			// 'categories' => 'required',
			// 'product_name' => 'required',
			// 'regular_price' => 'required',
			// 'sale_price' => 'required',
			// 'main_image' => 'required',
			// 'multi_image' => 'required',
			// 'tags' => 'required',
			// 'stock' => 'required',
			// 'sku_code' => 'required',
			// 'stock_status' => 'required'
		]);
           
            $product                               = Product::findOrFail($id);
            try{
                $main_image = Storage::disk('website')->put('products/main', $request->main_image);
            }catch(\Exception $e){}//end trycatch.
    
            if($request->hasfile('multi_image')){
                $last_row = DB::table('products')->latest()->first();
                if($last_row != null){
                    $last_id = ($last_row->id);
                }else{
                    $last_id = 0;
                }
                $no          = 1;
                foreach($request->file('multi_image') as $img){
                    $logo    =  "product_".($last_id)."_".$no.".".$img->extension();
                    $img->move(public_path('website/products/multi'), $logo);
                    $data[]  =$logo;
                    $no++;
                }
            }
            $product->multi_image                 =json_encode($data??'',true,JSON_UNESCAPED_SLASHES);
            $product->main_image                  =$main_image ?? "";
            $product->categories                  =$request->categories;
            $product->product_name                =$request->product_name;
            $product->regular_price               =$request->regular_price;
            $product->sale_price                  =$request->sale_price;
            $product->short_description           =$request->short_description;
            $product->long_description            =$request->long_description;
            if($request->has('color')){
                foreach($request->color as $colors){
                    $savecolors[] = $colors;
                }
            }
            $product->color                       =json_encode($savecolors);
            $tags                    = array();
            if($request->tags[0] != null){
                foreach (json_decode($request->tags[0]) as $key => $tag) {
                    array_push($tags, $tag->value);
                }
            }
            $product->tags                        = implode(',', $tags);
           
            $size                    = array();
            if($request->size[0] != null){
                foreach (json_decode($request->size[0]) as $key => $siz) {
                    array_push($size, $siz->value);
                }
            }
            $product->size                        = implode(',',$size);
            $product->stock                       =$request->stock;
            $product->sku_code                    =$request->sku_code;
            $product->manage_stock                =$request->manage_stock;
            $product->stock_status                =$request->stock_status;
            $product->status                      =$request->status;
            $product->is_featured                 =$request->is_featured;
            $product->brand                       =$request->brand;
            $product->related_products            =$request->related_products;
            $product->sale_price_start_date_time  =$request->sale_price_start_date_time;
            $product->sale_price_end_date_time    =$request->sale_price_end_date_time;
            $product->save();

             return redirect('product/product')->with('flash_message', 'Product updated!');
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
    public function destroy(Product $product)
    {
        $id= $product->id;
        $model = str_slug('product','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Product::destroy($id);

            return redirect('product/product')->with('flash_message', 'Product deleted!');
        }
        return response(view('403'), 403);

    }
}
