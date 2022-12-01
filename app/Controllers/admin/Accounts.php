<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Accounts extends BaseController
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
		$data['param'] = str_replace('https://'.$_SERVER['HTTP_HOST'].'/account/','',$actuaLlink);
	
		if($data['param']=='https://'.$_SERVER['HTTP_HOST'].'/account'){
			$data['param'] = '';
		} else {
			$data['param'] = '/'.$data['param'];
		}

		
		$data['pageTitle'] = 'Account';
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


		$data['pageCount'] = getAllPost($data['pageNumber'],$data['q'])->meta->pagination->pageCount;
		$data['allPost'] = getAllPost($data['pageNumber'],$data['q'])->data;
		return view('admin/posts',$data);
	}


	public function getAllPost($pageNumber=null)
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

		$allPost = getAllPostAdmin($data['pageNumber'],$data['q'])->data;
		

		if(count($allPost)==0){
			echo '
				<tr>
					<td colspan="6" class="text-center pt-2">
					<img src="'. base_url().SITE_URL.'assets/img/empty.png" class="img-fluid me-3" width="200"><br>
					<p class="text-secondary text-sm">Sorry, no data created yet.</p>
					</td>
				</tr>
			';
		}
		
		foreach($allPost as $post){ 
			$statusClass = ($post->attributes->Published)? 'info' : 'primary';
			$status = ($post->attributes->Published)? 'Published' : 'Draft';
			echo '
			<tr>
			  <td  style="min-width: 50px;max-width: 50px;">
					<img src="'.API_SITE.$post->attributes->image->data->attributes->formats->thumbnail->url.'" class="img-thumbnail me-3" width="100">
			  </td>
			  <td class="text-wrap" style="word-wrap: break-word !important;min-width: 160px;max-width: 160px;">
					<h6 class="mb-0 text-sm text-wrap" style="word-wrap: break-word">'. $post->attributes->title .'</h6>
			  </td>
			  
			  <td>
				<p class="text-xs font-weight-bold mb-0">'. date("d M Y",strtotime($post->attributes->updatedAt)) .'</p>
			  </td>

			  <td  class="align-middle text-center text-sm">
			  	<p class="text-xs mb-0">'. $post->attributes->category->data->attributes->name .'</p>
			  </td>

			  <td  class="align-middle text-center text-sm">
			  	<p class="text-xs mb-0">'. $post->attributes->penulis->data->attributes->username .'</p>
			  </td>
			  
			  <td  class="align-middle text-center text-sm">
				  <p class="text-xs mb-0">'. $post->attributes->penulis->data->attributes->opd->data->attributes->name .'</p>
		 	 </td>
			
			  <td class="align-middle text-center text-sm">
				<span class="badge badge-sm bg-gradient-'.$statusClass.'">'.$status.'</span>
			  </td>
			  
			  <td class="align-middle">
					<a href="'. base_url().SITE_URL.'post/editor/'.$post->id .'" class="text-sm" title="edit"><i class="fa fa-edit"></i></a>
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
		
		

		$pageCount = getAllPostAdmin($pageNumber,$q)->meta->pagination->pageCount;

		if($pageNumber>1){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'post/1'. $q .'"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></a></li>
			';
		}

	
		for($i=1; $i <= $pageCount ; $i++ ){
			$active = ($pageNumber==$i)? 'active' : '';
			
			if(($i > ($pageNumber-3)) AND ($i < $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'post/'. $i . $q .'">'. $i .'</a></li>
			';
			}

			if($i == $pageNumber) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'post/'. $i . $q .'">'. $i .'</a></li>
			';
			}

			if(($i < ($pageNumber+3)) AND ($i > $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'post/'. $i . $q .'">'. $i .'</a></li>
			';
			}

		
		 } 

		 if($pageNumber < $pageCount){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'post/'.$pageCount. $q .'"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
			';
		}

	}

	public function new($id = null)
	{
		if($id){
			$data['pageTitle'] = 'Edit Post';
		} else {
			$data['pageTitle'] = 'New Post';
		}
		$data['categories'] = getCategories();
	
		if(isset($id)){
			$data['id'] = $id;
			$article = getPostById($id);
			if($article->meta->pagination->total==0) {
				return redirect()->to(base_url().SITE_URL.'post'); 
			}
			$data['slug'] = $article->data[0]->attributes->slug; 
			$data['title'] = $article->data[0]->attributes->title; 
			$data['description'] = $article->data[0]->attributes->description; 
			$data['content'] = $article->data[0]->attributes->content;
			$data['published'] = $article->data[0]->attributes->Published; 
			$data['category'] = $article->data[0]->attributes->category->data;

			if($article->data[0]->attributes->image->data==NULL){
				$data['image']= (object) [
					'id' => ''
				];
			} else {
				$data['image'] = $article->data[0]->attributes->image->data; 
			}

			$data['created_at'] = date('j-n-Y H:i:s',strtotime($article->data[0]->attributes->createdAt)); 
			$data['updated_at'] = date('j-n-Y H:i:s',strtotime($article->data[0]->attributes->updatedAt));
			$data['author'] = $article->data[0]->attributes->penulis->data->attributes->username;
			$data['opd'] = $article->data[0]->attributes->penulis->data->attributes->opd->data->attributes->name;

			
		} else {
			$data['id'] = '';
			$data['slug'] ='';
			$data['title'] = '';
			$data['description'] = '';
			$data['content'] = '';
			$data['category'] = (object) [
				'id' => 0
			];
			$data['image'] = (object) [
				'id' => 1,
				'attributes' => (object) [
					'url' => '/uploads/default_image_e0ed843833.png'
				]
			];
			$data['created_at'] = '-';
			$data['updated_at'] = '-';
			$data['author'] = '-';
			$data['opd'] = '-';
			$data['published'] = false;
		}
		

		return view('admin/new_post',$data);
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

		$title = $post['data']['title'];
		$description = $post['data']['description'];
		$content = $post['content'];
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


		
		$temp_slug = strtolower(str_replace(" ","-",str_replace( array("#", "'", ";", ".", "}", "{", ",", "(", ")", "!", "?", "^", "*", "%"), '',rawurldecode($post['data']['title']))));
		$id_slug = 2;	
		$slug = strtolower(str_replace(" ","-",str_replace( array("#", "'", ";", ".", "}", "{", ",", "(", ")", "!", "?", "^", "*", "%"), '',rawurldecode($post['data']['title']))));


		while(getPostBySlug($slug)->meta->pagination->total > 0){
			$slug = $temp_slug.'-'.$id_slug;
			$id_slug++;
		}


		$Published = (array_key_exists("published",$post['data'])) ? 'true': 'false';
		$category = $post['data']['category'];
		$penulis = session()->userData->id; 
		$image = $cover;

		$data = [
			"data" => [
				"title" => $title,
				"description" => $description,
				"content" => $content,
				"slug" => $slug,
				"Published" => $Published,
				"category" => [
					"id" => $category
				],
				"penulis" => [
					"id" => $penulis
				],
				"image" => [
					"id" => $image
				]
			]
		];

		
		if($post['data']['id']!=''){
			$id = $post['data']['id'];
			$response = updateArticle($id,$data);
			
		} else {

			$response = postArticle($data);
		}
		
		echo json_encode($response);
		

	}


	public function upload()
	{
		$accepted_origins = array("http://localhost", "https://127.0.0.1", "https://backend.magelangkota.go.id"); 

	

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
				echo '{"location":"https:\/\/adminweb.magelangkota.go.id\/uploads\/'.$response->data[0]->hash.$response->data[0]->ext.'"}';

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
		$response = deleteArticle($post['id']);
		echo json_encode($response);
	}

}
