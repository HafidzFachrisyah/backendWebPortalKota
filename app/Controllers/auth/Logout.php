<?php namespace App\Controllers\auth;

use App\Controllers\BaseController;

class Logout extends BaseController
{

	public function __construct() {
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
		
    }

	public function index()
	{
		session()->destroy();
		return redirect()->to(base_url().SITE_URL); 
	}

	


}