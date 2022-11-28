<?php
function login($post_data){
    $data = $post_data;   
    $ch = curl_init(API_URL . 'auth/local');

    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    // execute!
    $response = curl_exec($ch);

    
    // close the connection, release resources used
    curl_close($ch);
    
    // do anything you want with your response
  return json_decode($response);

}

function getSiteName(){
   
  $authorization = "Authorization: Bearer ".API_TOKEN;
  
  $ch = curl_init(API_URL . 'global/?populate=*');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes->siteName;
  // do anything you want with your response
  
return $response;

}

function getSiteLogo(){
   
  $authorization = "Authorization: Bearer ".API_TOKEN;
  
  $ch = curl_init(API_URL . 'global/?populate=*');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes->favicon->data->attributes->url;
  $response = API_SITE.$response;
  // do anything you want with your response
  
return $response;

}


function getFrontEndUrl(){
   
  $authorization = "Authorization: Bearer ".API_TOKEN;
  
  $ch = curl_init(API_URL . 'global/?populate=*');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes->frontEndUrl;
  // do anything you want with your response
  
return $response;

}


function getUserData($jwt){
   
  $authorization = "Authorization: Bearer ".$jwt;
  
  $ch = curl_init(API_URL . 'users/me');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  // do anything you want with your response
  
return $response;

}


function getLatestPost(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'articles?populate[0]=category.*&populate[1]=penulis.opd&populate[3]=image.*&filters[penulis][id][$eq]='.$id_user.'&sort[1]=updatedAt%3Adesc&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data;
  // do anything you want with your response
  
return $response;

}

function getAllPost($pageNumber,$q){
   
  $q = urlencode($q);
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'articles?populate=*&filters[title][$containsi]='.$q.'&filters[penulis][id][$eq]='.$id_user.'&sort[1]=updatedAt%3Adesc&pagination[page]='.$pageNumber.'&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getAllPostAdmin($pageNumber,$q){
   
  $jwt = session()->jwt;
  $q = urlencode($q);
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'articles?populate[0]=category.*&populate[1]=penulis.opd&populate[3]=image.*&filters[title][$containsi]='.$q.'&sort[1]=updatedAt%3Adesc&pagination[page]='.$pageNumber.'&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getAllPublishedPost(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'articles?populate=*&filters[Published][$eq]=true&filters[Published][$eq]=true&filters[penulis][id][$eq]='.$id_user.'&sort[1]=updatedAt%3Adesc&pagination[page]=1&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getAllPublishedPostWidget(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'articles?populate=*&filters[Published][$eq]=true&filters[Published][$eq]=true&sort[1]=updatedAt%3Adesc&pagination[page]=1&pagination[pageSize]=5');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data;
  // do anything you want with your response
  
return $response;

}


function getAllDraftPost(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'articles?populate=*&filters[Published][$eq]=false&filters[penulis][id][$eq]='.$id_user.'&sort[1]=updatedAt%3Adesc&pagination[page]=1&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}


function getUser($q){

  $q = urlencode($q);
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'users?populate=*&filters[username][$containsi]='.$q.'&sort[1]=username%3Aasc');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getUserByUsername($username){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'users?populate=*&filters[username][$eq]='.$username);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getUserByEmail($email){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'users?populate=*&filters[email][$eq]='.$email);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getUserById($id){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'users/'.$id.'?populate=*');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getOpd(){
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'opds?sort[1]=name%3Aasc&pagination[page]=1&pagination[pageSize]=100');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  $response = json_decode($response);
  $response = $response->data;
  
  // do anything you want with your response
  
return $response;

}

function getCategories(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  
  $ch = curl_init(API_URL . 'categories');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data;
  // do anything you want with your response
  
return $response;

}


function postUpload($file,$type,$name){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'upload';

  $headers = array("Content-Type:multipart/form-data",$authorization); // cURL headers for file uploading
  $postfields = array("files" => new CURLFILE(@$file,$type,$name));
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => $postfields,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FRESH_CONNECT => TRUE
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);

  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function getPostBySlug($slug){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'articles?populate=*&filters[slug][$eq]='.$slug.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}


function postArticle($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'articles';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function postUser($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'users';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}

function updateArticle($id,$data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'articles/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function updateProfile($data){

  $jwt = session()->jwt;
  $id_user = session()->userData->id;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'users/'.$id_user;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function updateUser($data,$id_user){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'users/'.$id_user;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}

function updatePassword($data){

  $jwt = session()->jwt;
  $id_user = session()->userData->id;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'users/'.$id_user;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}



function deleteArticle($id){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'articles/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}

function deleteUser($id){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'users/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}



function getPostById($id){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'articles?populate[0]=category.*&populate[1]=penulis.opd&populate[3]=image.*&filters[id][$eq]='.$id.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}


function getAllPage($pageNumber,$q){
   
  $q = urlencode($q);
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'pages?populate=*&filters[title][$containsi]='.$q.'&sort[1]=updatedAt%3Adesc&pagination[page]='.$pageNumber.'&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getAllPublishedPage(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'pages?populate=*&filters[title][$containsi]=&filters[Published][$eq]=true&sort[1]=updatedAt%3Adesc');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data;
  // do anything you want with your response
  
return $response;

}

function getPageBySlug($slug){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'pages?populate=*&filters[slug][$eq]='.$slug.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}


function deletePage($id){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'pages/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function updatePage($id,$data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'pages/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function postPage($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'pages';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function getPageById($id){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'pages?populate=*&filters[id][$eq]='.$id.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}


//banner

function getAllBanner($pageNumber){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'banners?populate=*&sort[1]=updatedAt%3Adesc&pagination[page]='.$pageNumber.'&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function deleteBanner($id){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'banners/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function updateBanner($id,$data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'banners/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function postBanner($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'banners';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function getBannerById($id){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'banners?populate=*&filters[id][$eq]='.$id.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}



//infograph

function getAllInfograph($pageNumber){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $id_user = session()->userData->id;
  $ch = curl_init(API_URL . 'infographs?populate=*&sort[1]=updatedAt%3Adesc&pagination[page]='.$pageNumber.'&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function deleteInfograph($id){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'infographs/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function updateInfograph($id,$data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'infographs/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function postInfograph($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'infographs';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function getInfographById($id){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'infographs?populate=*&filters[id][$eq]='.$id.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}






//menu

function getAllMenu(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'main-menus');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data[0]->attributes->menu;
  
  // do anything you want with your response
  
return $response;

}


function updateMenu($data){
  
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'main-menus/1';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  $payload = json_encode(array("data" => array("menu" =>json_decode($data['data']['menu'], true))));

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => $payload,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}



//lending menu

function getAllLendingMenu(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'landing-menus');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data[0]->attributes->menu;
  
  // do anything you want with your response
  
return $response;

}


function updateLendingMenu($data){
  
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'landing-menus/1';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  $payload = json_encode(array("data" => array("menu" =>json_decode($data['data']['menu'], true))));

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => $payload,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}

function getAllCategories(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'categories');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data;
  
  // do anything you want with your response
  
return $response;

}

//Other-links function

function getAllOtherlink($pageNumber,$q){
   
  $q = urlencode($q);
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'layanan-links?filters[nama][$containsi]='.$q.'&sort[1]=updatedAt%3Adesc&pagination[page]='.$pageNumber.'&pagination[pageSize]=15');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}


function deleteOtherLink($id){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'layanan-links/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function updateOtherLink($id,$data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'layanan-links/'.$id;

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function postOtherLink($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'layanan-links';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function getOtherLinkById($id){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'layanan-links?filters[id][$eq]='.$id.'&pagination[page]=1&pagination[pageSize]=1');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response;
  // do anything you want with your response
  
return $response;

}

function getMediaLink(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'media-link/?populate=*');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes->item;
  // do anything you want with your response
  
return $response;

}

function updateMediaLink($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'media-link';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}


function getGlobal(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'global');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes;
  // do anything you want with your response
  
return $response;

}


function getHeader(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'header');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes;
  // do anything you want with your response
  
return $response;

}


function getFooter(){
   
  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $ch = curl_init(API_URL . 'footer');
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));

  
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
  // execute!
  $response = curl_exec($ch);
  
  // close the connection, release resources used
  curl_close($ch);
  
  $response = json_decode($response);
  $response = $response->data->attributes;
  // do anything you want with your response
  
return $response;

}


function updateGlobal($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'global';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}

function updateHeader($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'header';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);

  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}

function updateFooter($data){

  $jwt = session()->jwt;
  $authorization = "Authorization: Bearer ".$jwt;
  $url = API_URL . 'footer';

  $headers = array("Content-Type:application/json",$authorization); // cURL headers for file uploading
  $postfields = json_encode($data);

  
  
  $ch = curl_init();
  $options = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_POST => 1,
      CURLOPT_CUSTOMREQUEST => 'PUT',
      CURLOPT_HTTPHEADER => $headers,
      CURLOPT_POSTFIELDS => rawurldecode($postfields),
      CURLOPT_RETURNTRANSFER => true
  ); // cURL options

  curl_setopt_array($ch, $options);
  $response = curl_exec($ch);
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  
  $response = json_decode($response);
  $data = [
    "data" => $response,
    "status" => $httpcode
  ];
  
 
  return (object) $data;

}
?>