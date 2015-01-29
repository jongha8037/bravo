<?php
class ViewController extends BaseController {

	public function pageLogin()
	{
		return View::make('login');
	}

	public function pageSignup()
	{
		return View::make('signup');
	}

	public function pageLoginResult()
	{
		return View::make('loginResult');
	}

	public function pageFindpassword()
	{
		return View::make('findpassword');
	}
}
