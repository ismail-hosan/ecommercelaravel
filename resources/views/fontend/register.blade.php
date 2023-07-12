@extends('fontend.layout.main')
@section('content')

<br><br><br>
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Create Account</h4>
	<form action="{{url('post-register')}}" method="post" id="regForm">
		{{csrf_field()}}

    @if($message = Session::get('status'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
    @endif

       @if($message = Session::get('success'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{$message}}</strong>
        </div>
    @endif

	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="name" class="form-control" placeholder="Full name" type="text">
        @if($errors->has('name'))
        <span class="error">{{$errors->first('name')}}</span>
        @endif
    </div>
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email">
        @if($errors->has('email'))
        <span class="error">{{$errors->first('email')}}</span>
        @endif
    </div> 
  
   
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Create password" type="password" name="password">
        @if($errors->has('password'))
        <span class="error">{{$errors->first('password')}}</span>
        @endif
    </div> 
    <div>
        
    
    </div>
                                      
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
    </div>      
    <p class="text-center">Have an account? <a href="{{url('login')}}">Log In</a> </p>                                                                 
</form>
</article>
</div>
</div> 
@endsection