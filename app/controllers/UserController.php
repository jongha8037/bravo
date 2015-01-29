<?php
 
class UserController extends \BaseController {
 
    public function __construct()
    {
        $this->beforeFilter('auth');
    }
 
    /**
     * Display a listing of the user.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
 
        return View::make('user.index', ['users' => $users]);
    }
 
    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('user.create');

    }
 
    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = new User;
 
        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->username   = Input::get('username');
        $user->email      = Input::get('email');
        $user->password   = Hash::make(Input::get('password'));


        if(Input::get('password') == Input::get('password_confirmation')){
            $user->save();        
            return Redirect::to('/user');
        }
        else{
            return Redirect::back()
            ->withInput()
            ->withErrors('Check your password again.');

        }
 
    }
 
    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);
 
        return View::make('user.edit', [ 'user' => $user ]);
    }
 
    /**
     * Update the specified user in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $user = User::find($id);
 
        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->username   = Input::get('username');
        $user->email      = Input::get('email');
        $user->password   = Hash::make(Input::get('password'));
 
        if(Input::get('password') == Input::get('password_confirmation')){
            $user->save();        
            return Redirect::to('/user');
        }
        else{
            return Redirect::back()
            ->withInput()
            ->withErrors('Check your password again.');

        }

    }

    
    public function findPassword()
    {
        $input = Input::only('email', 'username', 'password');
        $rules = array(
            'email' => 'required|email',
            );
            $messages = array(
            'required' => ':attribute을 입력하세요.',
            'email' => '올바른 형태의 이메일이 아닙니다.',
            );
            $validation = Validator::make(Input::all(), $rules, $messages);
            if($validation->fails())
            {
                return Redirect::to('findpassword')->withErrors($validation)->withInput(); 
            }
            else {
                return Redirect::to('findpassword');
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
 
        return Redirect::to('/user');
    }
 
}
