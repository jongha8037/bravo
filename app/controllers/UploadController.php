<?php
class UploadController extends BaseController {
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function upload()
	{
		$image=Input::file('image');
		if(!$image){
			return Redirect::back();
		}
		$filename=$image->getClientOriginalName();
		$time=date("YmdHis");
		$filename=$time.$filename;
		$path = public_path('img/'.$filename);

		if(Image::make($image->getRealPath())->resize('380', '600')->save($path)){


	$product = new Product;
	$product->title = $filename;
	$product->image = $filename;


	$saveflag = $product->save();
			return Redirect::to('/');
		}
	}
}