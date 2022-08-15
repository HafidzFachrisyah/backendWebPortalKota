<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Otherlinks extends BaseController
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
		$data['param'] = str_replace('https://'.$_SERVER['HTTP_HOST'].'/otherlink/','',$actuaLlink);
	
		if($data['param']=='https://'.$_SERVER['HTTP_HOST'].'/otherlink'){
			$data['param'] = '';
		} else {
			$data['param'] = '/'.$data['param'];
		}

		
		$data['pageTitle'] = 'Other Links';
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


		$data['pageCount'] = getAllOtherLink($data['pageNumber'],$data['q'])->meta->pagination->pageCount;
		$data['allOtherLinks'] = getAllOtherLink($data['pageNumber'],$data['q'])->data;

		return view('admin/otherlinks',$data);
	}


	public function getAllOtherLink($pageNumber=null)
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

		$allOtherLink = getAllOtherLink($data['pageNumber'],$data['q'])->data;

		if(count($allOtherLink)==0){
			echo '
				<tr>
					<td colspan="4" class="text-center pt-2">
					<img src="'. base_url().SITE_URL.'assets/img/empty.png" class="img-fluid me-3" width="200"><br>
					<p class="text-secondary text-sm">Sorry, no data created yet.</p>
					</td>
				</tr>
			';
		}

		foreach($allOtherLink as $otherLink){ 
			echo '
			<tr>
			  <td class="text-wrap ms-3" style="word-wrap: break-word;min-width: 160px;max-width: 160px;">
					<p class="mb-0 text-sm text-wrap ms-3">'. $otherLink->attributes->nama .'</p>
			  </td>
			  
			  <td>
				<p class="text-xs mb-0">'. $otherLink->attributes->url .'</p>
			  </td>
			
			  
			  <td class="align-middle">
					<a href="'. base_url().SITE_URL.'otherlink/editor/'.$otherLink->id .'" class="text-sm" title="edit"><i class="fa fa-edit"></i></a>
			  </td>
			</tr>
			';
			} 
	}



	public function getOtherLinkCount($pageNumber=null)
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
		
		
		
		$otherLinkCount = getAllOtherLink($pageNumber,$q)->meta->pagination->pageCount;

		if($pageNumber>1){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'otherlink/1'. $q .'"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></a></li>
			';
		}

		for($i=1; $i <= $otherLinkCount ; $i++ ){
			$active = ($pageNumber==$i)? 'active' : '';
			if(($i > ($pageNumber-3)) AND ($i < $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'otherlink/'. $i . $q .'">'. $i .'</a></li>
			';
			}

			if($i == $pageNumber) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'otherlink/'. $i . $q .'">'. $i .'</a></li>
			';
			}

			if(($i < ($pageNumber+3)) AND ($i > $pageNumber)) {
				echo '
				<li class="page-item '. $active .'"><a class="page-link '. $active .'" href="'. BASE_URL().SITE_URL.'otherlink/'. $i . $q .'">'. $i .'</a></li>
			';
			}
		 } 

		 if($pageNumber<$otherLinkCount){
			echo '
				<li class="page-item"><a class="page-link" href="'. BASE_URL().SITE_URL.'otherlink/'.$otherLinkCount. $q .'"><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></li>
			';
			
		}

	}

	public function new($id = null)
	{
		if($id){
			$data['pageTitle'] = 'Edit Link';
		} else {
			$data['pageTitle'] = 'New Link';
		}
	
		if(isset($id)){
			$data['id'] = $id;
			$otherLink = getOtherLinkById($id);
			if($otherLink->meta->pagination->total==0) {
				return redirect()->to(base_url().SITE_URL.'otherlink'); 
			}
			$data['nama'] = $otherLink->data[0]->attributes->nama; 
			$data['url'] = $otherLink->data[0]->attributes->url; 

			$data['created_at'] = date('j-n-Y H:i:s',strtotime($otherLink->data[0]->attributes->createdAt)); 
			$data['updated_at'] = date('j-n-Y H:i:s',strtotime($otherLink->data[0]->attributes->updatedAt));
		
			
		} else {
			$data['id'] = '';
			$data['nama'] ='';
			$data['url'] = '';
			
			$data['created_at'] = '-';
			$data['updated_at'] = '-';
		}
		

		return view('admin/new_otherlink',$data);
	}

	public function store()
	{
		$otherLink = $this->request->getVar();

		$otherLink['data'] = explode('&', $otherLink['data']);
		foreach($otherLink['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$otherLink['data'][$singleData[0]] = $singleData[1];
		}

		$nama = $otherLink['data']['nama'];
		$url = $otherLink['data']['url'];


		$data = [
			"data" => [
				"nama" => $nama,
				"url" => $url
			]
		];

		
		if($otherLink['data']['id']!=''){
			$id = $otherLink['data']['id'];
			$response = updateOtherLink($id,$data);
			
		} else {

			$response = postOtherLink($data);
		}
		
		echo json_encode($response);
		

	}

	public function delete()
	{
		$otherLink = $this->request->getVar();
		$response = deleteOtherLink($otherLink['id']);
		echo json_encode($response);
	}

}
