<?php
class RemindController extends BaseController {

	public function postRemind()
	{
		$credentials = array('email' => Input::get('email'));
		$response = Password::remind($credentials, function($message, $user)
		{
   			$message->subject('비밀번호 재설정 링크입니다.');
		});
		switch($response) {
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));
			case Password::REMINDER_SENT:
				return Redirect::to('/');
	}
		}
		
	public function getReset($token)
	{
		return View::make('passwordReset')->with('token', $token);
	}

	public function postReset()
	{
			$credentials = Input::only('password', 'password_confirmation', 'token');
		$rules = array(
	        'password' => 'required|min:3',
	        'password_confirmation' => 'required|min:3|same:password',
	    	);
	    	$messages = array(
	        'required' => ':attribute을 입력하세요.',
	        'min' => ':attribute를 6자리 이상 입력하세요.',
	        'same' => '비밀번호와 확인 비밀번호가 다릅니다.'
	    	);
	    	$validation = Validator::make(Input::all(), $rules, $messages);

	    	if($validation->fails())
	    	{
	     		return Redirect::to('password/reset/token')->withErrors($validation)->withInput(); 
	    	}
	    	else {

	    		$token = Input::get('token');
	    		$email = array('email'=>DB::table('password_reminders')->where('token',$token)->pluck('email'));			
			$credentials = array_merge($email, $credentials);

	    	 	$response = Password::reset($credentials, function($user, $password)
		{		
			$user->password = Hash::make($password);
			$user->save();


		});

	    	 	
		return Redirect::to('/');



		}





	}
}
