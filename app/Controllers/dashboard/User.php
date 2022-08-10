<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class User extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }


	public function adduser()
	{
		
		$data['current_user'] = session()->current_user;
		return view('admin/adduser',$data);
	}

	public function createuser()
	{
		$post['name'] = $this->request->getPost('name');
		$post['email'] = $this->request->getPost('email');
		$post['phone_number'] = $this->request->getPost('phone_number');
		$post['password_user'] = $this->request->getPost('password_user');
		$post['password_user2'] = $this->request->getPost('password_user2');
		$post['id_role'] = $this->request->getPost('id_role');

		$insert = adduser($post);

		if(property_exists($insert,'success')){
			
			// session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $this->form_validation->getErrors());
            session()->setFlashdata('success', 'Pengguna baru berhasil ditambahkan.');
			return redirect()->to(base_url('adduser'));
			
		} else {
			session()->setFlashdata('inputs', $this->request->getPost());
			session()->setFlashdata('errors', $insert->errors);
			return redirect()->to(base_url('adduser'));
		}

	}



	public function user()
	{
		$data['current_user'] = session()->current_user;
		return view('admin/user',$data);
	}

}