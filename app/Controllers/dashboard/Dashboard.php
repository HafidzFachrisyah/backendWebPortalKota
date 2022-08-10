<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function index()
	{
		$data['total_users'] = totalusers()->data;
		$data['current_user'] = session()->current_user;
		
		return view('admin/dashboard',$data);
	}


}