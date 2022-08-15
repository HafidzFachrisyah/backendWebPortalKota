<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Banners extends BaseController
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
		$data['param'] = str_replace('https://'.$_SERVER['HTTP_HOST'].'/banner/','',$actuaLlink);
	
		if($data['param']=='https://'.$_SERVER['HTTP_HOST'].'/banner'){
			$data['param'] = '';
		} else {
			$data['param'] = '/'.$data['param'];
		}

		
		$data['pageTitle'] = 'Banners';
		$get = $this->request->getGet();
		

		if($pageNumber!=null){
			$data['pageNumber']=$pageNumber;
		} else {
			$data['pageNumber']=1;
		}


		$data['pageCount'] = getAllBanner($data['pageNumber'])->meta->pagination->pageCount;
		$data['allBanner'] = getAllBanner($data['pageNumber'])->data;
		return view('admin/banners',$data);
	}


	public function getAllBanner($pageNumber=null)
	{
		

		$get = $this->request->getGet();
		
	
		if($pageNumber!=null){
			$data['pageNumber']=$pageNumber;
		} else {
			$data['pageNumber']=1;
		}

		$allBanner = getAllBanner($data['pageNumber'])->data;

		if(count($allBanner)==0){
			echo '
				<tr>
					<td colspan="6" class="text-center pt-2">
					<img src="'. base_url().SITE_URL.'assets/img/empty.png" class="img-fluid me-3" width="200"><br>
					<p class="text-secondary text-sm">Sorry, no data created yet.</p>
					</td>
				</tr>
			';
		}
		
		foreach($allBanner as $banner){ 
			$statusClass = ($banner->attributes->Published)? 'info' : 'primary';
			$status = ($banner->attributes->Published)? 'Published' : 'Draft';
			echo '
			<tr>
			  <td>
					<img src="'.API_SITE.$banner->attributes->image->data->attributes->formats->thumbnail->url.'" class="img-thumbnail me-3" width="100">
			  </td>
			 
			  <td>
				<p class="text-xs font-weight-bold mb-0">'. date("d M Y",strtotime($banner->attributes->updatedAt)) .'</p>
			  </td>
			
			  <td class="align-middle text-center text-sm">
				<span class="badge badge-sm bg-gradient-'.$statusClass.'">'.$status.'</span>
			  </td>
			  
			  <td class="align-middle">
					<a href="'. base_url().SITE_URL.'banner/editor/'.$banner->id .'" class="text-sm" title="edit"><i class="fa fa-edit"></i></a>
			  </td>
			</tr>
			';
			} 
	}



	public function getPageCount($pageNumber=null)
	{
		
		$get = $this->request->getGet();

		
		if($pageNumber!=NULL){
			$pageNumber = $pageNumber;
		} else {
			$pageNumber =1;
		}
		
		

		$pageCount = getAllBanner($pageNumber)->meta->pagination->pageCount;

		if($pageNumber>1){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'banner/1><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></a></li>
			';
		}

		for($i=1; $i <= $pageCount ; $i++ ){
			$active = ($pageNumber==$i)? 'active' : '';

			if(($i > ($pageNumber-3)) AND ($i < $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'banner/'. $i .'">'. $i .'</a></li>
			';
			}

			if($i == $pageNumber) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'banner/'. $i .'">'. $i .'</a></li>
			';
			}

			if(($i < ($pageNumber+3)) AND ($i > $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'banner/'. $i .'">'. $i .'</a></li>
			';
			}

		 } 

		 if($pageNumber < $pageCount){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'banner/'.$pageCount.'"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
			';
			
		}

	}

	public function new($id = null)
	{
		if($id){
			$data['pageTitle'] = 'Edit Banner';
		} else {
			$data['pageTitle'] = 'New Banner';
		}
	
		if(isset($id)){
			$data['id'] = $id;
			$banner = getBannerById($id);
			if($banner->meta->pagination->total==0) {
				return redirect()->to(base_url().SITE_URL.'banner'); 
			}
			
			$data['published'] = $banner->data[0]->attributes->Published; 
			

			if($banner->data[0]->attributes->image->data==NULL){
				$data['image']= (object) [
					'id' => ''
				];
			} else {
				$data['image'] = $banner->data[0]->attributes->image->data; 
			}

			$data['created_at'] = date('j-n-Y H:i:s',strtotime($banner->data[0]->attributes->createdAt)); 
			$data['updated_at'] = date('j-n-Y H:i:s',strtotime($banner->data[0]->attributes->updatedAt));
			
		} else {
			$data['id'] = '';
			
			$data['image'] = (object) [
				'id' => 1,
				'attributes' => (object) [
					'url' => '/uploads/default_image_e0ed843833.png'
				]
			];
			$data['created_at'] = '-';
			$data['updated_at'] = '-';
			
			$data['published'] = false;
		}
		

		return view('admin/new_banner',$data);
	}

	public function store()
	{
		$cover = 1;
		$post = $this->request->getVar();

		$post['data'] = explode('&', $post['data']);
		foreach($post['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$post['data'][$singleData[0]] = $singleData[1];
		}

	
		if($_FILES){
			$temp = $_FILES['cover-0']; 
			if (is_uploaded_file($temp['tmp_name'])){ 
	
				// Sanitize input 
				if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) { 
					header("HTTP/1.1 400 Invalid file name."); 
					return; 
				} 
			 
				// Verify extension 
				if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) { 
					header("HTTP/1.1 400 Invalid extension."); 
					return; 
				} 
	
				$type = $temp['type'];
				$name = $temp['name'];
				$filetowrite = $temp['tmp_name'];
	
				$response = postUpload($filetowrite,$type,$name);
				
				if($response->status == 200){ 
					
					$cover = $response->data[0]->id;
	
				} 
	
			}
		} else {
			$cover = $post['data']['cover-default'];
			if($cover==null){
				$cover = 1;
			}
		}


		$Published = (array_key_exists("published",$post['data'])) ? 'true': 'false';
		$image = $cover;

		$data = [
			"data" => [
				"Published" => $Published,
				"image" => [
					"id" => $image
				]
			]
		];

		
		if($post['data']['id']!=''){
			$id = $post['data']['id'];
			$response = updateBanner($id,$data);
			
		} else {

			$response = postBanner($data);
		}
		
		echo json_encode($response);
		

	}


	public function upload()
	{
		$accepted_origins = array("http://localhost", "https://127.0.0.1", "https://dev.backend.magelangkota.go.id"); 

	

		if (isset($_SERVER['HTTP_ORIGIN'])) { 
			// same-origin requests won't set an origin. If the origin is set, it must be valid. 
			if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) { 
				header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']); 
			} else { 
				header("HTTP/1.1 403 Origin Denied"); 
				return; 
			} 
		} 
		 
		// Don't attempt to process the upload on an OPTIONS request 
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') { 
			header("Access-Control-Allow-Methods: POST, OPTIONS"); 
			return; 
		} 
		 
		reset ($_FILES); 
		$temp = current($_FILES); 
		if (is_uploaded_file($temp['tmp_name'])){ 
			/* 
			  If your script needs to receive cookies, set images_upload_credentials : true in 
			  the configuration and enable the following two headers. 
			*/ 
			// header('Access-Control-Allow-Credentials: true'); 
			// header('P3P: CP="There is no P3P policy."'); 
		 
			// Sanitize input 
			if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) { 
				header("HTTP/1.1 400 Invalid file name."); 
				return; 
			} 
		 
			// Verify extension 
			if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) { 
				header("HTTP/1.1 400 Invalid extension."); 
				return; 
			} 
		 
		
		 
			$type = $temp['type'];
			$name = $temp['name'];
			$filetowrite = $temp['tmp_name'];

			$response = postUpload($filetowrite,$type,$name);

			//var_dump($filetowrite);die();
			
			if($response->status == 200){ 
				echo '{"location":"https:\/\/dev.adminweb.magelangkota.go.id\/uploads\/'.$response->data[0]->hash.$response->data[0]->ext.'"}';

			}else{ 
				header("HTTP/1.1 400 Upload failed."); 
				return; 
			} 
		} else { 
			// Notify editor that the upload failed 
			header("HTTP/1.1 500 Server Error"); 
		} 

	}


	public function delete()
	{
		$post = $this->request->getVar();
		$response = deleteBanner($post['id']);
		echo json_encode($response);
	}

}
