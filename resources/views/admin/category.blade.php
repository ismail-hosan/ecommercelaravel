@extends('admin.layout')
@section('page_title','Category')
@section('category_select','active')
@section('container')
<div>
    <h1>Category Table</h1>
</div><br>
<a href="{{url('admin/manage_catagory')}}">
    <button type="button" class="btn btn-success">Add Category</button>
</a>
@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif

<div class="main-content">
                <div class="section__content section__content--p20">
                    <div class="container-fluid">                        
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Delete</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($data as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->title}}</td>
                                                <td>
                                                    <a href="{{url('admin/category/delete')}}/{{$data->id}}">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td>
                                                @if($data->status==1)
                                                <td>
                                                    <a href="{{url('admin/category/status/0')}}/{{$data->id}}">
                                                        <button type="submit" class="btn btn-primary">Active</button>
                                                    </a>
                                                </td>
                                                @else
                                                <td>
                                                    <a href="{{url('admin/category/status/1')}}/{{$data->id}}">
                                                        <button type="submit" class="btn btn-warning">Deactive</button>
                                                    </a>
                                                </td>
                                                @endif
                                                <td>
                                                    <a href="{{url('admin/category/edit')}}/{{$data->id}}">
                                                        <button type="submit" class="btn btn-danger">Edit</button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection