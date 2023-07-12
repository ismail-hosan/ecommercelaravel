<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = Color::all();
        return view('admin/color',$result);
    }

    

    public function manage_color(Request $request,$id='')
    {
        if($id > 0)
        {
            
            $arr = Color::where(['id'=>$id])->get();

            $result['color_name'] = $arr['0']->color_name;
            $result['color_slug'] = $arr['0']->color_slug;
            $result['id'] = $arr['0']->id;
        }
        else
        {
            $result['color_name'] = '';
            $result['color_slug'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_color',$result);
    }

    public function manage_color_process(Request $request)
    {
        //dd($request->post());
        $request->validate([
            

        ]);
        if($request->post('id') > 0)
        {
            $model = Color::find($request->post('id'));
            $msg = 'Color Updated';
        }
        else
        {
            $model = new Color();
            $msg = 'Color Inserted';
        }

        $model->color_name = $request->post('color_name');
        $model->color_slug = $request->post('color_slug');
        $model->status = 1;
        $model->save();
        $request->session()->flash('success',$msg);
        return redirect('admin/color');

    }

    public function delete(Request $request,$id)
    {
        $result = Color::find($id);
        $result->delete();
        $request->session()->flash('error','Color Delete Succesfully');
        return redirect()->route('admin.color');
    }

    public function status(Request $request,$status,$id)
    {
        $result = Color::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('success','Category Status Updated');
        return redirect()->route('admin.color');
    }
}
