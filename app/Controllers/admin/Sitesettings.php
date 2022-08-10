<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;

class Sitesettings extends BaseController
{

	public function __construct() {
        helper('uauthapi');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
    }

	public function index()
	{
		
		$data['pageTitle'] = 'Site Setting';
		$data['global'] = getGlobal();
		$data['header'] = getHeader();
		$data['footer'] = getFooter();

		return view('admin/sitesetting',$data);

	}


	public function store()
	{
		$sitesetting = $this->request->getVar();
		
		$sitesetting['data'] = explode('&', $sitesetting['data']);
		foreach($sitesetting['data'] as $singleData ){
			$singleData = explode('=', $singleData);
			$sitesetting['data'][$singleData[0]] = $singleData[1];
		}
		

		//global
		$siteName= $sitesetting['data']['siteName'];
		$frontEndUrl= $sitesetting['data']['frontEndUrl'];

		//header
		$title= $sitesetting['data']['title'];
		$tagline= $sitesetting['data']['tagline'];
		$description= $sitesetting['data']['description'];
		$link= $sitesetting['data']['link'];

		//footer
		$alamat= $sitesetting['data']['alamat'];
		$telp= $sitesetting['data']['telp'];
		$fax= $sitesetting['data']['fax'];
		$email= $sitesetting['data']['email'];

	

		$dataGlobal = [
			"data" => [
				"siteName" => $siteName,	
				"frontEndUrl" => $frontEndUrl
			]

		];

		$dataHeader = [
			"data" => [
				"title" => $title,
				"tagline" => $tagline,
				"description" => $description,
				"link" => $link
			]

		];



		$dataFooter = [
			"data" => [
				"alamat" => $alamat,
				"telp" => $telp,
				"email" => $email,
				"fax" => $fax
			]

		];

		
		$responseGlobal = updateGlobal($dataGlobal);
		$responseHeader = updateHeader($dataHeader);
		$responseFooter = updateFooter($dataFooter);

		$response = new \stdClass();

		if($responseGlobal->status == 200 AND $responseHeader->status == 200 AND $responseFooter->status == 200) {
			$response->status = 200;
		} else {
			$response->status = 500;
		}
		
		
		
		echo json_encode($response);
		

	}


}
