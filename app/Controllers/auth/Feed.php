<?php namespace App\Controllers\auth;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Feed extends BaseController
{
	use ResponseTrait;

	public function __construct() {
		helper('uauthapi');
		helper(['form', 'url','strapiapi']);
		$request = \Config\Services::request();
		$this->uri = $request->uri; //class request digunakan untuk request uri/url
		
    }

	public function youtube()
	{
		$rss_feed = simplexml_load_file("https://www.youtube.com/feeds/videos.xml?channel_id=UCxGnkCaN3qxICxov_IoAcfQ");
		if(!empty($rss_feed)) {
			$i=0;
			foreach ($rss_feed->entry as $feed_item) {
				if($i>=5) break;
	
					$id =  substr($feed_item->id,9);
				
					if($i!=1){
						$data[]=[
								"embed_link" => 'https://www.youtube.com/embed/'.$id,
								"youtube_link" => 'https://www.youtube.com/watch?v='.$id,
								"title" => (string)$feed_item->title,
								"thumbnail" => 'https://i2.ytimg.com/vi/'.$id.'/hqdefault.jpg'
						]; 
					}
				$i++;	
			}
			
			return $this->respond($data);
		}
		
	}

	public function latestyoutube()
	{
		$rss_feed = simplexml_load_file("https://www.youtube.com/feeds/videos.xml?channel_id=UCxGnkCaN3qxICxov_IoAcfQ");
		if(!empty($rss_feed)) {
			$i=0;
			foreach ($rss_feed->entry as $feed_item) {
				if($i>=1) break;
	
					$id =  substr($feed_item->id,9);
				
					
						$data[]=[
								"embed_link" => 'https://www.youtube.com/embed/'.$id,
								"youtube_link" => 'https://www.youtube.com/watch?v='.$id,
								"title" => (string)$feed_item->title,
								"thumbnail" => 'https://i2.ytimg.com/vi/'.$id.'/hqdefault.jpg'
						]; 
					
				$i++;	
			}
			
			return $this->respond($data);
		}
		
	}


	public function widget()
	{
		$data['data'] = getAllPublishedPostWidget();
		return view('feed/widget',$data);
		
	}

	public function radio()
	{
		
		return view('feed/radio');
		
	}

	


}