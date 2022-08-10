<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Setting extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function updateprofile()
	{
		
		$post['id_user'] = session()->current_user->id_user;
		$post['name'] = $this->request->getPost('name');
		$post['email'] = $this->request->getPost('email');
		$post['phone_number'] = $this->request->getPost('phone_number');

		$update = updateprofile($post);

		if(property_exists($update,'success')){
			echo 1;
			
		} else {
			foreach($update->errors as $error){
				echo "<li class=\"ml-2 mb-1\">";
				echo $error;
				echo "</li>";
			}
		}

		
		
		
	}

	public function resetpassword()
	{
		
		$post['id_user'] = session()->current_user->id_user;
		$post['password_user'] = $this->request->getPost('password_user');
		$post['password_user2'] = $this->request->getPost('password_user2');

		$reset = resetpassword($post);

		if(property_exists($reset,'success')){
			echo 1;
			
		} else {
			
			foreach($reset->errors as $error){
				echo "<li class=\"ml-2 mb-1\">";
				echo $error;
				echo "</li>";
			}
		}

		
		
		
	}


}