<?php
 
class HomeController extends BaseController {
 
    public function getIndex()
    {
        return View::make('home.index');
    }
 
    public function postIndex()
    {
        $email = Input::get('email');
        $password = Input::get('password');
 
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return Redirect::intended('/user');
        }
 
        return Redirect::back()
            ->withInput()
            ->withErrors('That username/password combo does not exist.');
    }
 /*
    public function postIndex()
    {
        $username = Input::get('username');
        $password = Input::get('password');
 
        if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            return Redirect::intended('/user');
        }
 
        return Redirect::back()
            ->withInput()
            ->withErrors('That username/password combo does not exist.');
    }
 */
    public function getLogin()
    {
        return Redirect::to('/');
    }
 
    public function getLogout()
    {
        Auth::logout();
 
        return Redirect::to('/');
    }

 
}
