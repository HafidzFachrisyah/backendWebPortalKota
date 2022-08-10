<?php namespace App\Controllers\admin;

use App\Controllers\BaseController;
// use CodeIgniter\RESTful\ResourceController;
use App\Models\ApkModel;


class Download extends BaseController
{

	public function __construct() {
        helper(['form', 'url']);
		$this->request = \Config\Services::request();
		$this->uri = $this->request->uri; //class request digunakan untuk request uri/url
		$this->ApkModel = new ApkModel; 
    }


	public function download()
	{
		$data['no'] = 0;
		$data['apks'] = $this->ApkModel->get()->getResult();
		// dd($data['apks']);
		$data['current_user'] = session()->current_user;
		
		return view('admin/download',$data);
	}

	public function downloadapk()
	{
		
		$id_apk = $this->request->getVar("id_apk");



		$rules = [
			"id_apk" => "required"
		];
		
		//dd($this->validate($rules));

		if (!$this->validate($rules)) {

			$response = [
				'success' => false,
				'msg' => "Gagal, tidak ditemukan APK",
			];

			return $this->response->setJSON($response);
		} else {

			$response = [
				'success' =>true,
				'msg' => "Tunggu, sedang menyiapkan file.",
				'url' => base_url().'/downloading/apk/'.$id_apk
			];

			return $this->response->setJSON($response);
			//return $this->response->download('pubs/apks/'.$file_name, null)->setFileName($apk_name);
			

			
		}
	}
	
	public function downloadingapk($id_apk)
	{
		
		$curent_apk = $this->ApkModel->select('name_file,label_file')->where('id_apk',$id_apk)->first();

		$file_name =  $curent_apk['name_file'];
		$apk_name =  $curent_apk['label_file'];

		return $this->response->download('pubs/apks/'.$file_name, null)->setFileName($apk_name);
			

	}
	

	public function updateapk()
	{	

			helper('filesystem');
            $id_apk = $this->request->getVar("id_apk");

			$old_name = $this->ApkModel->select('name_file')->where('id_apk',$id_apk)->first();

			$rules = [
				"id_apk" => "required",
				"file" => [
					"rules" => "uploaded[file]|max_size[file,40024]|mime_in[file,application/zip,application/vnd.android.package-archive]",
					"label" => "Apk File",
				],
			];

			if (!$this->validate($rules)) {

				$response = [
					'success' => false,
					'msg' => "Gagal, file tidak sesuai kententuan, Max 40Mb",
				];

				return $this->response->setJSON($response);
			} else {

				$file = $this->request->getFile('file');

				$apk_file = $file->getName();

				// Renaming file before upload
				$unixname = round(microtime(true));
				$rev_unixname = strrev($unixname);  
				$newfilename = $unixname . '_'.$id_apk.'_' . $rev_unixname;

				if($old_name['name_file']!==''){
					if(file_exists(FCPATH."pubs/apks/".$old_name['name_file'])){
						$delete = unlink(FCPATH."pubs/apks/".$old_name['name_file']);
					}
				}
				
			

				if ($file->move("pubs/apks", $newfilename)) {



					$data = [
						"name_file" => $newfilename,
					];

					if ($this->ApkModel->update($id_apk,$data)) {

						$response = [
							'success' => true,
							'msg' => "Berhasil update APK.",
						];
					} else {

						$response = [
							'success' => false,
							'msg' => "Gagal update APK.",
						];
					}

					return $this->response->setJSON($response);
				} else {

					$response = [
						'success' => false,
						'msg' => "Gagal upload APK.",
					];

					return $this->response->setJSON($response);
				}
			}
		}
	

}