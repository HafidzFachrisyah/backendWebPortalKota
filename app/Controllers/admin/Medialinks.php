<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Medialinks extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function index()
	{
		
		$data['pageTitle'] = 'Media Social';
		$data['mediaLink'] = getMediaLink();
		return view('admin/medialink',$data);
	}


	public function store()
	{
		$mediaLink = $this->request->getVar();
		
		$mediaLink['data'] = explode('&', $mediaLink['data']);
		foreach($mediaLink['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$mediaLink['data'][$singleData[0]] = $singleData[1];
		}
		

	
		$label1= $mediaLink['data']['label-1'];
		$label2= $mediaLink['data']['label-2'];
		$label3= $mediaLink['data']['label-3'];
		$label4= $mediaLink['data']['label-4'];

		$url1= $mediaLink['data']['url-1'];
		$url2= $mediaLink['data']['url-2'];
		$url3= $mediaLink['data']['url-3'];
		$url4= $mediaLink['data']['url-4'];

	

		$data = [
			"data" => [
				"id" => 1,
				"createdAt" => "2022-07-04T08:06:18.457Z",
				"updatedAt" => "2022-08-04T07:34:10.581Z",
				"item" => array(
						[
							"__component" => "itemlink.link-item",	
							"id" => 1,
							"name" => "Facebook",
							"url" => $url1,
							"label" => $label1,
						],
						[
							"__component" => "itemlink.link-item",	
							"id" => 2,
							"name" => "Youtube",
							"url" => $url2,
							"label" => $label2,
						],
						[
							"__component" => "itemlink.link-item",	
							"id" => 3,
							"name" => "Instagram",
							"url" => $url3,
							"label" => $label3,
						],
						[
							"__component" => "itemlink.link-item",	
							"id" => 4,
							"name" => "Twitter",
							"url" => $url4,
							"label" => $label4,
						]),
				"createdBy" => 1,
				"updatedBy" => 1
			]
		];

		
			$response = updateMediaLink($data);
		
		echo json_encode($response);
		

	}


}
