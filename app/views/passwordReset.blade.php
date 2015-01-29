@extends('layouts.master')
 
@section('title') Create User @stop
 
@section('content')



<div class="col-lg-10 col-lg-offset-1">
 
	<h1><i class="fa fa-users"></i> Password RESET </h1>

	<h3> Please input new password. </h3>

    {{ Form::open(['role' => 'form']) }}


    <input type="hidden" name="token" value="{{ $token }}">


    <div class='form-group'>
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
    </div>

    <div class='form-group'>
        {{ Form::label('password_confirmation', 'Password_confirmation') }}
        {{ Form::password('password_confirmation', ['placeholder' => 'Password', 'class' => 'form-control']) }}
    </div>
 
    <div class='form-group'>
        {{ Form::submit('Check', ['class' => 'btn btn-primary']) }}
    </div>
 	<button class="btn btn-primary" type="button" id="rt">Login</button>
    {{ Form::close() }}
 
 
<!--   {{ Form::open(['role' => 'form', 'url' => '/user']) }}  -->
 


<script>
	var returnbutton = document.getElementById('rt');
	returnbutton.onclick = function() {
		location.href="../../";
	}
</script>

 

 
@stop