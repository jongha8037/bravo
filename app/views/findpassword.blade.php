@extends('layouts.master')
 
@section('title') Users @stop
 
@section('content')
 
<div class="col-lg-10 col-lg-offset-1">
 
	<h1><i class="fa fa-users"></i> Search Password </h1>

	<h3> Please input your Email. We post security code. </h3>

    {{ Form::open(['role' => 'form']) }}
 
    <div class='form-group'>
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
    </div>
 
    <div class='form-group'>
        {{ Form::submit('Check', ['class' => 'btn btn-primary']) }}
    </div>
 
    {{ Form::close() }}

 
@stop