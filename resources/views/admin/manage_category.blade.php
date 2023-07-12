@extends('admin.layout')
@section('page_title','manage_category')
@section('container')
<div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">New Category Add</div>
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center title-2">Category Ditails</h3>
                                        </div>
                                        @if ($message = Session::get('success'))
                                        <div class="alert alert-danger alert-block">
	                                        <button type="button" class="close" data-dismiss="alert">×</button>	
                                                <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        <hr>
                                        <form action="{{url('admin/category/manage_category_process')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                                <input id="category_name" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$category_name}}" require>
 
                                            </div>
                                            <div class="form-group has-success">
                                                <label for="cc-name" class="control-label mb-1">Catagory Slug</label>
                                                <input id="catagory_slug" name="catagory_slug" type="text" class="form-control cc-name valid" data-val="true"  value="{{$catagory_slug}}" require>
                                                <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                                            </div>
                                           
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <span id="payment-button-amount">Submit</span>
                                                </button>
                                            </div>
                                            <input type="hidden" name="id" value="{{$id}}">
                                        </form>
                                    </div>
                                </div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
@endsection            