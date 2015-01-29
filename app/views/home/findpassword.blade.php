@extends('master')

@section('content')
<style type="text/css">
	.input {
		text-align: center;
		color: blue;
		margin-bottom: 40px;
	}
</style>
<div class="container">
	<h2 class="login">FIND PASSWORD</h2>
	<form class="myform" method="POST">
		<p class="input">가입할 때 입력하신 이메일을 입력해주세요.<br>이메일로 인증번호를 보내드리겠습니다.</p>
		<p class="p_texttype">
			<span class="email">email</span><input type="text" id="email" class="text1 form-control" name="email" placeholder="email"><br>
		</p>
		<div class="div_btn">
			<button class="btn btn-primary" type="submit">Submit</button>
		</div>
	</form>
</div>
@stop