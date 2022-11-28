<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class User extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }


	public function index($pageNumber=null)
	{
		$actuaLlink = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$data['param'] = str_replace('https://'.$_SERVER['HTTP_HOST'].'/user/','',$actuaLlink);
	
		if($data['param']=='https://'.$_SERVER['HTTP_HOST'].'/user'){
			$data['param'] = '';
		} else {
			$data['param'] = '/'.$data['param'];
		}

		
		$data['pageTitle'] = 'Users';
		$get = $this->request->getGet();

		if(array_key_exists('q', $get)){
			$data['q']=$get['q'];
		} else {
			$data['q']='';
		}
		

		if($pageNumber!=null){
			$data['pageNumber']=$pageNumber;
		} else {
			$data['pageNumber']=1;
		}


		
		
		$data['allUser'] = getUser($data['q']);
		
		return view('admin/user',$data);
	}


	public function getAllUser()
	{
		

		$get = $this->request->getGet();

		if(array_key_exists('q', $get)){
			$data['q']=$get['q'];
		} else {
			$data['q']='';
		}
		

		$allUser = getUser($data['q']);
		

		if(count($allUser)==0){
			echo '
				<tr>
					<td colspan="6" class="text-center pt-2">
					<img src="'. base_url().SITE_URL.'assets/img/empty.png" class="img-fluid me-3" width="200"><br>
					<p class="text-secondary text-sm">Sorry, no data created yet.</p>
					</td>
				</tr>
			';
		}
		
		foreach($allUser as $user){ 
			
			echo '
			<tr>
			  <td class="text-wrap ps-3">
					<h6 class="mb-0 text-sm ms-2">'. $user->username .'</h6>
			  </td>
			

			  <td  class="align-middle text-sm">
			  	<p class="text-xs mb-0">'. $user->email .'</p>
			  </td>

			  <td  class="align-middle text-center text-sm">
			  	<p class="text-xs mb-0">'. $user->opd->name .'</p>
			  </td>
			 
			  
			  <td class="align-middle text-right">
					<a href="'. base_url().SITE_URL.'user/editor/'.$user->id .'" class="text-sm" title="edit"><i class="fa fa-edit"></i></a>
					<a href="'. base_url().SITE_URL.'user/reset/'.$user->id .'" class="text-sm" title="reset"><i class="fa fa-key"></i></a>
			  </td>
			</tr>
			';
			} 
	}


	public function new($id = null)
	{

		if($id){
			$data['pageTitle'] = 'Edit User';
		} else {
			$data['pageTitle'] = 'New User';
		}
		$data['opds'] = getOpd();
	
		if(isset($id)){
			$data['id'] = $id;
			$user = getUserById($id);
			
			if(!$user) {
				return redirect()->to(base_url().SITE_URL.'user'); 
			}
			$data['username'] = $user->username; 
			$data['email'] = $user->email; 
			$data['opd'] = $user->opd->id;

			
		} else {
			$data['id'] = '';
			$data['username'] ='';
			$data['email'] = '';
			$data['opd'] = '-';
		}

		return view('admin/new_user',$data);
	}


	public function resetUser($id)
	{

		$data['pageTitle'] = 'Reset Password User';
		
		
	
		if(isset($id)){
			$data['id'] = $id;
			$user = getUserById($id);
			
			if(!$user) {
				return redirect()->to(base_url().SITE_URL.'user'); 
			} else {
				$data['username'] = $user->username;
			}

		} 

		return view('admin/reset',$data);
	}


	public function store()
	{
		
		$post = $this->request->getVar();

		$post['data'] = explode('&', $post['data']);
		foreach($post['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$post['data'][$singleData[0]] = $singleData[1];
		}


		

		
		if($post['data']['id']!=''){
			$id = $post['data']['id'];

			$opd = $post['data']['opd'];

			$data = [
					"opd" =>  $opd
				
			];

			$response = updateUser($data,$id);
			
		} else {

			$username = $post['data']['username'];
			$email = $post['data']['email'];

			if(count(getUserByUsername($username))!=0){

				$response = [
					'data' => [
						'error' => [
							'message' => 'Username was taked by someone else !'
						]
		
					]
				];

			} elseif(count(getUserByEmail($email))!=0){

				$response = [
					'data' => [
						'error' => [
							'message' => 'Email was taked by someone else !'
						]
		
					]
				];


			}else {

				
				$opd = $post['data']['opd'];
				$password = $post['data']['password'];

				$data = [
					
						"confirmed" => true,
						"blocked" => false,
						"username" => $username,
						"email" => $email,
						"opd" => $opd,
						"password" => $password,
						"role" => 3,
					
				];

				$response = postUser($data);

				
				echo json_encode($response);
			}
			
		}

		
		
		

	}




	public function profile()
	{
			$data['pageTitle'] = 'Profile';
	
		
			$user = getUserData(session()->jwt);

			$data['data'] = $user;
			
		

		return view('admin/profile',$data);
	}

	public function password()
	{
			$data['pageTitle'] = 'Password';
			return view('admin/password',$data);
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

		if(count(getUserByUsername($username))!=0){

			$response = [
				'data' => [
					'error' => [
						'message' => 'Username was taked by someone else !'
					]
	
				]
			];

		} else {

			$data = [
				"username" => $username
			];

		
			$response = updateProfile($data);

		}

	

		
			
		
		
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

	public function delete()
	{
		$post = $this->request->getVar();
		$response = deleteUser($post['id']);
		echo json_encode($response);
	}

	

}