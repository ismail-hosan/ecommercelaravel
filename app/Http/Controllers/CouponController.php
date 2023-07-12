<?php

namespace App\Http\Controllers;

use App\Models\admin\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class CouponController extends Controller
{
    public function index()
    {
        $result['data'] = Coupon::all();
        return view('admin/coupon',$result);
    }


    public function manage_coupon(Request $request,$id='')
    {
        if($id > 0)
        {
            
            $arr = Coupon::where(['id'=>$id])->get();

            $result['coupon_name'] = $arr['0']->title;
            $result['coupon_slug'] = $arr['0']->code;
            $result['coupon_value'] = $arr['0']->value;
            $result['id'] = $arr['0']->id;
        }
        else
        {
            $result['coupon_name'] = '';
            $result['coupon_slug'] = '';
            $result['coupon_value'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_coupon',$result);
    }

    public function manage_coupon_process(Request $request)
    {
        //dd($request->post());
        //dd($request->post());
        $request->validate([
            'coupon_name' =>'required',
            'coupon_slug' =>'requires|unique:category,code',

        ]);
        if($request->post('id') > 0)
        {
            $model = Coupon::find($request->post('id'));
            $msg = 'Category Updated';
        }
        else
        {
            $model = new Coupon();
            $msg = 'Category Inserted';
        }

        $model->title = $request->post('coupon_name');
        $model->code = $request->post('coupon_slug');
        $model->value = $request->post('coupon_value');
        $model->save();
        $request->session()->flash('success',$msg);
        return redirect('admin/coupon');

    }

    public function delete(Request $request,$id)
    {
        $result = Coupon::find($id);
        $result->delete();
        $request->session()->flash('success','Category Delete Succesfully');
        return redirect()->route('admin.category');
    }

    public function status(Request $request,$status,$id)
    {
        $result = Coupon::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('success','Coupon Status Updated');
        return redirect()->route('admin.coupon');
    }
}
