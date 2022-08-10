<?php namespace App\Controllers\opd;

use App\Controllers\BaseController;

class User extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }


	public function profile()
	{
			$data['pageTitle'] = 'Profile';
	
		
			$user = getUserData(session()->jwt);

			$data['data'] = $user;
			
		

		return view('opd/profile',$data);
	}

	public function password()
	{
			$data['pageTitle'] = 'Password';
			return view('opd/password',$data);
	}

	public function update()
	{
		
		$post = $this->request->getVar();

		$post['data'] = explode('&', $post['data']);
		foreach($post['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$post['data'][$singleData[0]] = $singleData[1];
		}

		$username = $post['data']['username'];

	

		$data = [
				"username" => $username
			];

		
			$response = updateProfile($data);
			
		
		
		echo json_encode($response);
		

	}


	public function reset()
	{
		
		$post = $this->request->getVar();
		$pattern = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,30}$/";

		$post['data'] = explode('&', $post['data']);
		foreach($post['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$post['data'][$singleData[0]] = $singleData[1];
		}

		$password = $post['data']['password'];
		$password2 = $post['data']['password2'];

		if(preg_match($pattern, $password)){

			if($password == $password2){
				$data = [
					"password" => $password,
				];
	
				$response = updatePassword($data);
	
			} else {
				$response = [
					'data' => [
						'error' => [
							'message' => 'Password not match !'
						]
	
					]
				];
			}

		} else {
			$response = [
				'data' => [
					'error' => [
						'message' => 'Password must be 8 to 30 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character !'
					]
				]
			];
		}
			
		
		
		echo json_encode($response);
		

	}

	

}