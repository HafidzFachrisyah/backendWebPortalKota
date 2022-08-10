<?php namespace App\Controllers\opd;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function index()
	{
		$data['pageTitle'] = 'Dashboard';
		$latestPost = getLatestPost();
		$allPost = getAllPost(1,'');
		$allPublishedPost = getAllPublishedPost();
		$allDraftPost = getAllDraftPost();
		$data['totalPost'] = $allPost->meta->pagination->total;
		$data['totalPublishedPost'] = $allPublishedPost->meta->pagination->total;
		$data['totalDraftPost'] = $allDraftPost->meta->pagination->total;
		if(count($latestPost)>0){
			$data['latestPost'] = $latestPost[0];
		} else {
			$data['latestPost'] = null;
		}
		return view('opd/dashboard',$data);
	}

	public function getAllPost()
	{
		$allPost = getAllPost(1,'');
		$data['totalPost'] = $allPost->meta->pagination->total;
		echo $data['totalPost'];
	}

	public function getAllPublishedPost()
	{
		$allPublishedPost = getAllPublishedPost();
		$data['totalPublishedPost'] = $allPublishedPost->meta->pagination->total;
		echo $data['totalPublishedPost'];
	}

	public function getAllDraftPost()
	{
		
		$allDraftPost = getAllDraftPost();
		$data['totalDraftPost'] = $allDraftPost->meta->pagination->total;
		echo $data['totalDraftPost'];
	}


	public function getLatestPost()
	{
		
		$latestPost = getLatestPost();
		if(count($latestPost)>0){
			$data = $latestPost[0];

			if($data->attributes->Published){
				$status = '<span class="badge badge-xs bg-gradient-info">Published</span>';
			} else {
				$status = '<span class="badge badge-xs bg-gradient-primary">Draft</span>';
			}

			echo '
			<div class="row mt-4">
			<div class="col-lg-12 mb-lg-0 mb-4">
			  <div class="card">
				<div class="card-body p-3">
				  <div class="row">
					<div class="col-lg-6">
					  <div class="d-flex flex-column h-100">
						<p class="mb-1 pt-2 text-bold">
						  Latest Post  '.$status.'<br>
						  <span class="text-secondary text-xs"> Catergory : '.$data->attributes->category->data->attributes->name.' || Penulis : '.$data->attributes->penulis->data->attributes->username.' || OPD : '.$data->attributes->penulis->data->attributes->opd->data->attributes->name.'<br>
						 	<i class="fa fa-calendar"> '.date('d M Y',strtotime($data->attributes->updatedAt)).'</i> 
						  </span>
						</p>
						<h5 class="font-weight-bolder">'. $data->attributes->title .'</h5>
						<p class="mb-5">'. $data->attributes->description .'</p>
						<a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="'.base_url().SITE_URL.'post/editor/'.$data->id.'">
						  View
						  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
						</a>
					  </div>
					</div>
					<div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
					  <div class="border-radius-lg h-100">
						<img src="'.base_url().SITE_URL.'assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
						<div class="position-relative d-flex align-items-center justify-content-center h-100">
						  <img class="w-100 position-relative z-index-2 shadow-sm rounded img-thumbnail" src="'.API_SITE.$data->attributes->image->data->attributes->formats->thumbnail->url.'" alt="cover">
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
			';

		} else {
			echo '
			<div class="row mt-4">
				<div class="col-lg-12 mb-lg-0 mb-4 text-center">
				<p>There no post to display..</p>
				</div>
			</div>
			';
		}
	}




}