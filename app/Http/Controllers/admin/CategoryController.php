<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function index()
    {
        $result['data'] = Category::all();
        return view('admin/category',$result);
    }

    public function addall(Request $request)
    {
        //dd($request->all());
        $request->validate([

                'category_name'=>'required',
                'catagory_slug'=>'required',

        ]);
        $post = new Category;
        $post->name = $request->category_name;
        $post->title = $request->catagory_slug;
        $post->save();

        return redirect()->route('admin.manage_category')->with('success','Post has been created successfully');
    }
    

    public function manage_category(Request $request,$id='')
    {
        if($id > 0)
        {
            
            $arr = Category::where(['id'=>$id])->get();

            $result['category_name'] = $arr['0']->name;
            $result['catagory_slug'] = $arr['0']->title;
            $result['id'] = $arr['0']->id;
        }
        else
        {
            $result['category_name'] = '';
            $result['catagory_slug'] = '';
            $result['id'] = 0;
        }
        return view('admin/manage_category',$result);
    }

    public function manage_category_process(Request $request)
    {
        //dd($request->post());
        $request->validate([
            'category_name' =>'required',
            'category_slug' =>'requires|unique:category,caregory_slug'.$request->post('id'),

        ]);
        if($request->post('id') > 0)
        {
            $model = Category::find($request->post('id'));
            $msg = 'Category Updated';
        }
        else
        {
            $model = new Category();
            $msg = 'Category Inserted';
        }

        $model->name = $request->post('category_name');
        $model->title = $request->post('catagory_slug');
        $model->status = 1;
        $model->save();
        $request->session()->flash('success',$msg);
        return redirect('admin/category');

    }

    public function delete(Request $request,$id)
    {
        $result = Category::find($id);
        $result->delete();
        $request->session()->flash('error','Category Delete Succesfully');
        return redirect()->route('admin.category');
    }

    public function status(Request $request,$status,$id)
    {
        $result = Category::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('success','Category Status Updated');
        return redirect()->route('admin.category');
    }
}
