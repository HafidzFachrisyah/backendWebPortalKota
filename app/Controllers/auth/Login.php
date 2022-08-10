<?php namespace App\Controllers\auth;

use App\Controllers\BaseController;

class Login extends BaseController
{

	public function __construct() {
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
		
    }

	public function index()
	{
		return view('login');
	}

	public function auth()
	{
		$post = $this->request->getPost();
		$response_key = $post['g-recaptcha-response'];
		$url_verify = "https://www.google.com/recaptcha/api/siteverify";
		$response = file_get_contents($url_verify."?secret=".SECRET_KEY."&response=".$response_key);
		$response = json_decode($response);

		if($response -> success == 1){

				$formData = [
					"identifier" => $post['email'],
					"password"	=> $post['password']
				]; 
		
		
				$login = login($formData);
		
				
				if (property_exists($login, 'error')) {
					session()->setFlashdata('inputs', $this->request->getPost());
					session()->setFlashdata('error', 'Email atau Password salah.');
					return redirect()->to(base_url().SITE_URL);
		
				} else {
					$jwt =  $login->jwt;
					$userData =  getUserData($jwt);
					session()->set('userData',$userData);
					session()->set('jwt',$jwt);
					return redirect()->to(base_url().SITE_URL);
				}

			}else{
					session()->setFlashdata('inputs', $this->request->getPost());
					session()->setFlashdata('error', 'You are robot, and we hate robot !, Please do not miss the captcha to verify that you are human.');
					return redirect()->to(base_url().SITE_URL);
			}

		

	}


}