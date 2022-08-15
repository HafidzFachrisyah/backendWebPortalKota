<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Injects extends BaseController
{

	public function __construct() {
        helper('uauthapi');
        helper('textcut');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
		ini_set('memory_limit', '-1');
    }


	public function store()
	{
		
		$product = new BeritaModel();
		$berita = $product->where('beritaCategori ', 'B_SKPD')->where('beritaType','TY')->where('beritaCreatedBy','rudi')->find();
		
		
		foreach($berita as $brt){

					$post['data']['title'] = $brt['beritaTitle'];
					$deskripsi = strip_tags($brt['beritaDeskripsi']);
					$deskripsi = substrwords($deskripsi,250);
					$post['data']['description'] =$deskripsi; 
					$post['content'] = $brt['beritaDeskripsi']; 

					$title = $post['data']['title'];
					$description = $post['data']['description'];
					$content = $post['content'];
					
					


					
					$temp_slug = strtolower(str_replace(" ","-",str_replace( array("#", "'", ";", ".", "}", "{", ",", "(", ")", "!", "?", "^", "*", "%"), '',rawurldecode($post['data']['title']))));
					$id_slug = 2;	
					$slug = strtolower(str_replace(" ","-",str_replace( array("#", "'", ";", ".", "}", "{", ",", "(", ")", "!", "?", "^", "*", "%"), '',rawurldecode($post['data']['title']))));


					while(getPostBySlug($slug)->meta->pagination->total > 0){
						$slug = $temp_slug.'-'.$id_slug;
						$id_slug++;
					}


				

					$data = [
						"data" => [
							"title" => $title,
							"description" => $description,
							"content" => $content,
							"slug" => $slug,
							"Published" => true,
							"category" => [
								"id" => 7
							],
							"penulis" => [
								"id" => 1
							],
							"image" => [
								"id" => 1
							]
						]
					];

					
					

						$response = postArticle($data);
		
		}

		
		

	}


}
