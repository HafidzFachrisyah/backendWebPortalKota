<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Pages extends BaseController
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
		$data['param'] = str_replace('https://'.$_SERVER['HTTP_HOST'].'/page/','',$actuaLlink);
	
		if($data['param']=='https://'.$_SERVER['HTTP_HOST'].'/page'){
			$data['param'] = '';
		} else {
			$data['param'] = '/'.$data['param'];
		}

		
		$data['pageTitle'] = 'Pages';
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


		$data['pageCount'] = getAllPage($data['pageNumber'],$data['q'])->meta->pagination->pageCount;
		$data['allPost'] = getAllPage($data['pageNumber'],$data['q'])->data;

		return view('admin/pages',$data);
	}


	public function getAllPage($pageNumber=null)
	{
		

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

		$allPage = getAllPage($data['pageNumber'],$data['q'])->data;

		if(count($allPage)==0){
			echo '
				<tr>
					<td colspan="4" class="text-center pt-2">
					<img src="'. base_url().SITE_URL.'assets/img/empty.png" class="img-fluid me-3" width="200"><br>
					<p class="text-secondary text-sm">Sorry, no data created yet.</p>
					</td>
				</tr>
			';
		}

		foreach($allPage as $page){ 
			$statusClass = ($page->attributes->Published)? 'info' : 'primary';
			$status = ($page->attributes->Published)? 'Published' : 'Draft';
			echo '
			<tr>
			  <td class="text-wrap" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">
					<h6 class="mb-0 text-sm text-wrap ms-2">'. $page->attributes->title .'</h6>
			  </td>
			  
			  <td>
				<p class="text-xs font-weight-bold mb-0">'. date("d M Y",strtotime($page->attributes->updatedAt)) .'</p>
			  </td>
			
			  <td class="align-middle text-center text-sm">
				<span class="badge badge-sm bg-gradient-'.$statusClass.'">'.$status.'</span>
			  </td>
			  
			  <td class="align-middle">
					<a href="'. base_url().SITE_URL.'page/editor/'.$page->id .'" class="text-sm" title="edit"><i class="fa fa-edit"></i></a>
			  </td>
			</tr>
			';
			} 
	}



	public function getPageCount($pageNumber=null)
	{
		
		$get = $this->request->getGet();

		if(array_key_exists('q', $get)){
			$q = '/'.$get['q'];
		} else {
			$q ='';
		}
		
		
		if($pageNumber!=NULL){
			$pageNumber = $pageNumber;
		} else {
			$pageNumber =1;
		}
		
		
		
		$pageCount = getAllPage($pageNumber,$q)->meta->pagination->pageCount;

		if($pageNumber>1){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'page/1'. $q .'"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></a></li>
			';
		}

		for($i=1; $i <= $pageCount ; $i++ ){
			$active = ($pageNumber==$i)? 'active' : '';
			
			if(($i > ($pageNumber-3)) AND ($i < $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'page/'. $i . $q .'">'. $i .'</a></li>
			';
			}

			if($i == $pageNumber) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'page/'. $i . $q .'">'. $i .'</a></li>
			';
			}

			if(($i < ($pageNumber+3)) AND ($i > $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'page/'. $i . $q .'">'. $i .'</a></li>
			';
			}

		 } 

		 if($pageNumber < $pageCount){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'page/'.$pageCount. $q .'"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
			';
			
		}

	}

	public function new($id = null)
	{
		if($id){
			$data['pageTitle'] = 'Edit Page';
		} else {
			$data['pageTitle'] = 'New Page';
		}
	
		if(isset($id)){
			$data['id'] = $id;
			$page = getPageById($id);
			if($page->meta->pagination->total==0) {
				return redirect()->to(base_url().SITE_URL.'page'); 
			}
			$data['slug'] = $page->data[0]->attributes->slug; 
			$data['title'] = $page->data[0]->attributes->title; 
			$data['content'] = $page->data[0]->attributes->content;
			$data['published'] = $page->data[0]->attributes->Published; 

			$data['created_at'] = date('j-n-Y H:i:s',strtotime($page->data[0]->attributes->createdAt)); 
			$data['updated_at'] = date('j-n-Y H:i:s',strtotime($page->data[0]->attributes->updatedAt));
		

			
		} else {
			$data['id'] = '';
			$data['slug'] ='';
			$data['title'] = '';
			$data['content'] = '';
			
			$data['created_at'] = '-';
			$data['updated_at'] = '-';
			
			$data['published'] = false;
		}
		

		return view('admin/new_page',$data);
	}

	public function store()
	{
		$page = $this->request->getVar();

		$page['data'] = explode('&', $page['data']);
		foreach($page['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$page['data'][$singleData[0]] = $singleData[1];
		}

		$title = $page['data']['title'];
		$content = $page['content'];

		
		$temp_slug = strtolower(str_replace(" ","-",str_replace( array("#", "'", ";", ".", "}", "{", ",", "(", ")", "!", "?", "^", "*", "%"), '',rawurldecode($page['data']['title']))));
		$id_slug = 2;	
		$slug = strtolower(str_replace(" ","-",str_replace( array("#", "'", ";", ".", "}", "{", ",", "(", ")", "!", "?", "^", "*", "%"), '',rawurldecode($page['data']['title']))));


		while(getPageBySlug($slug)->meta->pagination->total > 0){
			$slug = $temp_slug.'-'.$id_slug;
			$id_slug++;
		}


		$Published = (array_key_exists("published",$page['data'])) ? 'true': 'false';

		$data = [
			"data" => [
				"title" => $title,
				"content" => $content,
				"slug" => $slug,
				"Published" => $Published
			]
		];

		
		if($page['data']['id']!=''){
			$id = $page['data']['id'];
			$response = updatePage($id,$data);
			
		} else {

			$response = postPage($data);
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
		$page = $this->request->getVar();
		$response = deletePage($page['id']);
		echo json_encode($response);
	}

}
