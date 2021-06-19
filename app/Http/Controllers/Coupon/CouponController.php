<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
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
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $coupon = Coupon::where('coupon_code', 'LIKE', "%$keyword%")
                ->orWhere('coupon_start_date_time', 'LIKE', "%$keyword%")
                ->orWhere('coupon_end_date_time', 'LIKE', "%$keyword%")
                ->orWhere('coupon_type', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $coupon = Coupon::paginate($perPage);
            }

            return view('coupon.coupon.index', compact('coupon'));
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
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('coupon.coupon.create');
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
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            $this->validate($request, [
			'coupon_code' => 'required',
			'coupon_start_date_time' => 'required',
			'coupon_end_date_time' => 'required',
			'coupon_type' => 'required',
			'amount' => 'required'
		]);
            $requestData = $request->all();
            
            Coupon::create($requestData);
            return redirect('coupon/coupon')->with('flash_message', 'Coupon added!');
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
    public function show(Coupon $coupon)
    {
        $id = $coupon->id;
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $coupon = Coupon::findOrFail($id);
            return view('coupon.coupon.show', compact('coupon'));
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
    public function edit(Coupon $coupon)
    {
        $id = $coupon->id;
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $coupon = Coupon::findOrFail($id);
            $date = date_create_from_format('d/m/Y:H:i:s', $coupon->coupon_start_date_time);
            // $date->getTimestamp();
            return view('coupon.coupon.edit', compact('coupon','date'));
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
    public function update(Request $request, Coupon $coupon)
    {
        $id = $coupon->id;
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $this->validate($request, [
			'coupon_code' => 'required',
			'coupon_start_date_time' => 'required',
			'coupon_end_date_time' => 'required',
			'coupon_type' => 'required',
			'amount' => 'required'
		]);
            $requestData = $request->all();
            
            $coupon = Coupon::findOrFail($id);
             $coupon->update($requestData);

             return redirect('coupon/coupon')->with('flash_message', 'Coupon updated!');
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
    public function destroy(Coupon $coupon)
    {
        $id = $coupon->id;
        $model = str_slug('coupon','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Coupon::destroy($id);

            return redirect('coupon/coupon')->with('flash_message', 'Coupon deleted!');
        }
        return response(view('403'), 403);

    }
}
