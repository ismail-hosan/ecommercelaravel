@extends('admin.layout')
@section('page_title','Product')
@section('container')
@if($id>0)
{{$image_require=''}}
@else
{{$image_require='required'}}
@endif
<div class="main-content">
   <div class="section__content section__content--p30">
      <form action="{{url('admin/product/manage_product_process')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="container-fluid">
            <div class="row m-t-30">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header">New Product</div>
                        <div class="card-body">
                           <div class="card-title">
                              <h3 class="text-center title-2">Product Ditails</h3>
                              @if ($message = Session::get('success'))
                              <div class="alert alert-danger alert-block">
                                 <button type="button" class="close" data-dismiss="alert">×</button>	
                                    <strong>{{ $message }}</strong>
                              </div>
                              @endif
                              <hr>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Name</label>
                                 <input id="product_name" name="product_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_name}}" required>
                              </div>
                              <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <label for="cc-name" class="control-label mb-1"><b>Category</b></label><br>
                                       <select name="category_id" id="category_id" require>
                                          <option value="">Select Category</option>
                                          @foreach($category as $categories)
                                          @if($category_id == $categories->id)
                                          <option selected value="{{$categories->id}}">
                                          @else
                                          <option value="{{$categories->id}}">
                                          @endif
                                          {{$categories->name}}
                                          </option>
                                          @endforeach
                                       </select>
                                    </div>
                                    <div class="col-md-4">
                                       <label for="cc-payment" class="control-label mb-1">Product Brand</label>
                                       <input id="product_brand" name="product_brand" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_brand}}" required>
                                    </div>
                                    <div class="col-md-4">
                                       <label for="cc-payment" class="control-label mb-1">Product Model</label>
                                       <input id="product_model" name="product_model" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_model}}" required>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Slug</label>
                                 <input id="product_slug" name="product_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_slug}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Short Desc</label>
                                 <input id="product_short_desc" name="product_short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_short_desc}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Description</label>
                                 <input id="product_desc" name="product_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_desc}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Keyword</label>
                                 <input id="product_keyword" name="product_keyword" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_keyword}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Technical Spcepication</label>
                                 <input id="product_technical_spcepication" name="product_technical_spcepication" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_technical_spcepication}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Uses</label>
                                 <input id="product_uses" name="product_uses" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_uses}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Warranty</label>
                                 <input id="product_warranty" name="product_warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$product_warranty}}" required>
                              </div>
                              <div class="form-group">
                                 <label for="cc-payment" class="control-label mb-1">Product Image</label>
                                 <input id="image" name="image" type="file" class="form-control" value="{{$product_image}}" {{$image_require}}>
                              </div>
                              
                           </div> 
                        </div> 
                  </div> 
               </div> 
            </div> 
            <div><h4>Product Attr</h4></div>
            <div class="form-group">
               <div class="row m-t-30" id="product_attr-box">
                  @php
                  $loop_count_number = 1;
                  @endphp
                  @foreach($productAttArr as $key=>$val)
                  @php
                  $loop_count_pre = $loop_count_number;
                  $pAArr = (array)$val;
                  @endphp
                  
                     
                  
                  <div class="col-md-12" >
                  
                  <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
                     <div class="card" id="product_attr_{{$loop_count_number++}}">
                        <div class="card-body">
         
                           <div class="row">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Sku</label>
                                    <input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['sku']}}" required>
                                 </div>
                              </div>                               
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">MRP</label>
                                    <input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="" required>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['price']}}" required>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-name" class="control-label mb-1">Category</label><br>
                                    <select name="category_id_attr[]" id="category_id" require>
                                       <option value="">Select Category</option>
                                       @foreach($category as $categories)
                                       @if($category_id == $categories->id)
                                       <option selected value="{{$categories->id}}">
                                       @else
                                       <option value="{{$categories->id}}">
                                       @endif
                                       {{$categories->name}}
                                       </option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <label for="cc-name" class="control-label mb-1">Color</label><br>
                                 <select name="color_id[]" id="color_id" require>
                                    <option value="">Select Color</option>
                                    @foreach($colors as $color)
                                    @if($pAArr['color_id']==$color->id)
                                    <option selected value="{{$color->id}}">
                                    {{$color->color_name}}
                                    </option>
                                    @else
                                    <option value="{{$color->id}}">
                                    {{$color->color_name}}
                                    </option>
                                    @endif
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Qtz</label>
                                    <input id="qtz" name="qtz[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['qty']}}" required>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['attr_image']}}" required>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Action</label>
                                    @if($loop_count_number == 2)
                                       <button class="form-control btn btn-primary btn-lg" type="button" onclick="add_more()">Add</button>
                                    @else
                                       <a href="{{url('admin/product/product_attr_delete')}}/{{$pAArr['id']}}/{{$id}}">
                                          <button class="form-control btn btn-danger btn-lg" type="button" onclick="remove_more({{$loop_count_pre}})">&nbsp;Remove</button>
                                       </a>
                                    @endif   
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            <div>
            <!--Product image Attr-->
            <div><h4>Product Attr Image</h4></div>
            <div class="form-group">
               <div class="row m-t-30" id="product_image-box">
                  @php
                  $loop_image_count = 1;
                  @endphp
                  @foreach($productimagesArr as $key=>$val)
                  @php
                  $loop_count_pre = $loop_count_number;
                  $pIArr = (array)$val;
                  @endphp
                  
                     
                  
               <div class="col-md-12" >
                  
                  <input id="paiid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
                     <div class="card" id="product_images_{{$loop_count_number++}}">
                        <div class="card-body">
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       @if($pIArr['image']!='')
                                          <img width="100px" src="{{asset('admin-assets/category/images/'.$pIArr->image)}}" alt="">
                                       @endif   
                                       <label for="cc-payment" class="control-label mb-1">Image</label>
                                       <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" value="{{$pIArr['image']}}" required>
                                    </div>
                                 </div>
                           
                                 <div class="col-md-3">
                                    <div class="form-group">
                                       <label for="cc-payment" class="control-label mb-1">Action</label>
                                       @if($loop_count_number == 2)
                                          <button class="form-control btn btn-primary btn-lg" type="button" onclick="add_image_more()">Add</button>
                                       @else
                                          <a href="{{url('admin/product/product_image_delete')}}/{{$pIArr['id']}}/{{$id}}">
                                             <button class="form-control btn btn-danger btn-lg" type="button" onclick="remove_image_more({{$loop_count_pre}})">&nbsp;Remove</button>
                                          </a>
                                       @endif   
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <label for="attr_image" class="control-label mb-1"> Image</label>
                                    <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required>
                                    
                                 </div> 
                           
                              </div> 
                           </div>  
                        </div>
                     </div>
                     
                     
                  </div>
                  @endforeach
               </div>
            <div>               
         </div>
         <div>             
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            <span id="payment-button-amount">Submit</span>
         </button>
         </div>
         <input type="hidden" name="id" value="{{$id}}">
      </form>
   </div>  
</div>  

<script>
   var loop_count = 1;
   function add_more(){
      loop_count++;

      var html = '<div class="col-md-12"><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="row">';

      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Sku</label><input id="sku" name="sku[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div></div>';
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">MRP</label><input id="mrp" name="mrp[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div></div>';
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Price</label><input id="price" name="price[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div></div>';
      var category_id_html = jQuery('#category_id').html();
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-name" class="control-label mb-1">Category</label><br><select name="category_id_attr[]" id="category_id" required>'+category_id_html+'</select></div></div>';
      var color_id_html = jQuery('#color_id').html();
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-name" class="control-label mb-1">Color</label><br><select name="color_id[]" id="color_id" required>'+color_id_html+'</select></div></div>';
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Qtz</label><input id="qtz" name="qtz[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div></div>';
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Image</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div></div>';
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Action</label><button class="form-control btn btn-danger btn-lg" type="button" onclick=remove_more("'+loop_count+'")>&nbsp;Remove</button></div></div>';
      html+='</div></div></div></div>';

      jQuery('#product_attr-box').append(html);
      
      
   }
   function remove_more(loop_count)
   {
      jQuery('#product_attr_'+loop_count).remove()
   }


   function add_image_more(){
      loop_image_count++;
      var html='<div class="col-md-3"><label for="images" class="control-label mb-1"> Image</label><input id="image" name="image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
      html+='<div class="col-md-3"><div class="form-group"><label for="cc-payment" class="control-label mb-1">Action</label><button class="form-control btn btn-danger btn-lg" type="button" onclick=remove_more("'+loop_count+'")>&nbsp;Remove</button></div></div>';

      jQuery('#product_image-box').append(html);
   }
</script>

@endsection