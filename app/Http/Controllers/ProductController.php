<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Color;
use App\Models\Product_attr;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = Product::all();
        return view('admin/product',$result);
    }


    

    public function manage_product(Request $request,$id='')
    {
        if($id > 0)
        {
            
            $arr = Product::where(['id'=>$id])->get();

            $result['product_name'] = $arr['0']->name;
            $result['category_id'] = $arr['0']->category_id;
            $result['product_slug'] = $arr['0']->slug;
            $result['product_brand'] = $arr['0']->brand;
            $result['product_model'] = $arr['0']->model;
            $result['product_short_desc'] = $arr['0']->short_desc;
            $result['product_desc'] = $arr['0']->desc;
            $result['product_keyword'] = $arr['0']->keyword;
            $result['product_technical_spcepication'] = $arr['0']->technical_spcepication;
            $result['product_uses'] = $arr['0']->uses;
            $result['product_warranty'] = $arr['0']->warranty;
            $result['product_image'] = $arr['0']->image;
            $result['id'] = $arr['0']->id;

            
            $result['productAttArr']=DB::table('product_attrs')->where(['product_id'=>$id])->get();
            $productimagesArr = DB::table('productimages')->where(['products_id'=>$id])->get();

            if(!isset($productimagesArr[0]))
            {
                $result['productimagesArr'][0]['id']='';
                $result['productimagesArr'][0]['image']='';
            }
            else
            {
                $result['productimagesArr']=$productimagesArr;
            }
            

        }    
        else
        {
            
            $result['product_name'] = '';
            $result['category_id'] = '';
            $result['product_slug'] = '';
            $result['product_brand'] = '';
            $result['product_model'] = '';
            $result['product_short_desc'] = '';
            $result['product_desc'] = '';
            $result['product_keyword'] = '';
            $result['product_technical_spcepication'] = '';
            $result['product_uses'] = '';
            $result['product_warranty'] = '';
            $result['product_image'] = '';
            $result['id'] = 0;

            $result['productAttArr'][0]['id']='';
            $result['productAttArr'][0]['product_id']='';
            $result['productAttArr'][0]['sku']='';
            $result['productAttArr'][0]['price']='';
            $result['productAttArr'][0]['attr_image']='';
            $result['productAttArr'][0]['qty']='';
            $result['productAttArr'][0]['color_id']='';


            $result['productimagesArr'][0]['id']='';
            $result['productimagesArr'][0]['image']='';
            
            
            
        }
        $result['category']=DB::table('categories')->where(['status'=>1])->get();
        $result['colors']=DB::table('colors')->where(['status'=>1])->get();
        
        return view('admin/manage_product',$result);
    }

    
    public function manage_product_process(Request $request)
    {
        //echo '<pre>';
        //print_r($request->post());
        //die();
        
        if($request->post('id')>0){
            $model = Product::find($request->post('id'));
            $msg = 'Product Updated';
        }else{
            $model=new Product();
            $msg="Product inserted";
        }

        if($request->hasfile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('admin-assets/category/images',$filename);
            $model->image = $filename;
        }

        $model->category_id=$request->post('category_id');;
        $model->name=$request->post('product_name');
        $model->slug=$request->post('product_slug');
        $model->brand=$request->post('product_brand');
        $model->model=$request->post('product_model');
        $model->short_desc=$request->post('product_short_desc');
        $model->desc=$request->post('product_desc');
        $model->keyword=$request->post('product_keyword');
        $model->technical_spcepication=$request->post('product_technical_spcepication');
        $model->uses=$request->post('product_uses');
        $model->warranty=$request->post('product_warranty');
        $model->status=1;
        $model->save();
        $pid=$model->id;
        /*Product Attr Start*/  
        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku'); 
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price'); 
        $qtyArr=$request->post('qtz'); 
        $size_idArr=$request->post('category_id_attr'); 
        $color_idArr=$request->post('color_id'); 
        foreach($skuArr as $key=>$val){
            $productAttrArr['product_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['attr_image']='test';
            $productAttrArr['mrp']=$mrpArr[$key];
            $productAttrArr['price']=$priceArr[$key];
            $productAttrArr['qty']=$qtyArr[$key];
            if($color_idArr[$key]=='')
            {
                $productAttrArr['color_id']=0;
            }
            else
            {
                $productAttrArr['color_id']=$color_idArr[$key];
            }
               
            
            
        }
        
        foreach($paidArr as $key=>$val)
        {
            if($key!='')
            {
                DB::table('product_attrs')->where(['id'=>$key])->update($productAttrArr);
                $request->session()->flash('success','Product Updated');
            }
            else
            {
                
                DB::table('product_attrs')->insert($productAttrArr);
                $request->session()->flash('success','Product Inserted'); 
            } 
        }

        /*Product Attr End*/ 
        

        $request->session()->flash('message',$msg);
        return redirect('admin/product');
        
    }

    public function delete(Request $request,$id)
    {
        $result = Product::find($id);
        $result->delete();
        $request->session()->flash('error','Product Delete Succesfully');
        return redirect()->route('admin.product');
    }

    public function status(Request $request,$status,$id)
    {
        $result = Product::find($id);
        $result->status = $status;
        $result->save();
        $request->session()->flash('success','Product Status Updated');
        return redirect()->route('admin.product');
    }

    public function attr_delete(Request $request,$paid,$pid)
    {
        DB::table('product_attrs')->where(['id'=>$paid])->delete();
        return redirect('admin/manage_product/');
    }

    public function image_delete(Request $request,$paid,$pid)
    {
        DB::table('productimages')->where(['id'=>$paid])->delete();
        return redirect('admin/manage_product/');
    }

    

    
}