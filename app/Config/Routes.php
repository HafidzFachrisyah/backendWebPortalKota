<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */


if(empty(session()->userData)){

    //setup no login route
    $routes->setDefaultNamespace('App\Controllers\auth');
    $routes->setDefaultController('Login');
    $routes->setDefaultMethod('index');
    
    //feed route
    $routes->get('feed/latestyoutube', 'Feed::latestyoutube');
    $routes->get('feed/youtube', 'Feed::youtube');
    $routes->get('feed/radio', 'Feed::radio');
    $routes->get('feed/widget', 'Feed::widget');

    //login route
    $routes->get('login', 'Login');
    $routes->post('auth', 'Login::auth');

    //any undefinition url route to login
    $routes->get('/', 'Login');
    $routes->addRedirect(':any', '/');

} else {


        $jwt = session()->jwt;
   
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
        
        if(isset($response->error)){
            session()->destroy();
		    redirect()->to(base_url().SITE_URL); 

        }
        
     

    $routes->setDefaultNamespace('App\Controllers');

     //feed route
     $routes->get('feed/latestyoutube', 'auth\Feed::latestyoutube');
     $routes->get('feed/youtube', 'auth\Feed::youtube');
     $routes->get('feed/radio', 'auth\Feed::radio');
     $routes->get('feed/widget', 'auth\Feed::widget');
    
    if(strtolower(session()->userData->role->name)=='admin opd'){
        


         //dashboard route
        $routes->get('dashboard', 'opd\Dashboard');
        $routes->get('dashboard/getAllPost', 'opd\Dashboard::getAllPost');
        $routes->get('dashboard/getAllPublishedPost', 'opd\Dashboard::getAllPublishedPost');
        $routes->get('dashboard/getAllDraftPost', 'opd\Dashboard::getAllDraftPost');
        $routes->get('dashboard/getLatestPost', 'opd\Dashboard::getLatestPost');

        //post route
        $routes->get('post', 'opd\Posts');
        $routes->get('post/(:num)', 'opd\Posts/$1');
        $routes->get('post/getAllPost', 'opd\Posts::getAllPost');
        $routes->get('post/getAllPost/(:num)', 'opd\Posts::getAllPost/$1');
        $routes->get('post/getPageCount', 'opd\Posts::getPageCount');
	    $routes->get('post/getPageCount/(:num)/', 'opd\Posts::getPageCount/$1');
        $routes->get('post/getPageCount/(:num)', 'opd\Posts::getPageCount/$1');
        $routes->get('post/editor', 'opd\Posts::new');
        $routes->get('post/editor/(:num)', 'opd\Posts::new/$1');
        $routes->post('post/store', 'opd\Posts::store');
        $routes->post('post/upload', 'opd\Posts::upload');
        $routes->post('post/delete', 'opd\Posts::delete');

        

        //profile route
        $routes->get('user/profile', 'opd\User::profile');
        $routes->get('user/password', 'opd\User::password');
        $routes->post('user/profile', 'opd\User::update');
        $routes->post('user/password', 'opd\User::reset');

        //logout route
        $routes->get('logout', 'auth\Logout');
        
        
        // //setting route
        $routes->post('update/profile', 'opd\Setting::updateprofile');
        $routes->post('update/password', 'opd\Setting::resetpassword');
        
        //any undefinition url route to opd dashboard

        $routes->get('/', 'opd\Dashboard');
        $routes->addRedirect(':any', '/');

    } elseif(strtolower(session()->userData->role->name)=='admin kota'){
        
        //dashboard route
       $routes->get('dashboard', 'admin\Dashboard');
       $routes->get('dashboard/getAllPost', 'admin\Dashboard::getAllPost');
       $routes->get('dashboard/getAllPublishedPost', 'admin\Dashboard::getAllPublishedPost');
       $routes->get('dashboard/getAllDraftPost', 'admin\Dashboard::getAllDraftPost');
       $routes->get('dashboard/getLatestPost', 'admin\Dashboard::getLatestPost');

       //post route
       $routes->get('post', 'admin\Posts');
       $routes->get('post/(:num)', 'admin\Posts/$1');
       $routes->get('post/getAllPost', 'admin\Posts::getAllPost');
       $routes->get('post/getAllPost/(:num)', 'admin\Posts::getAllPost/$1');
       $routes->get('post/getPageCount', 'admin\Posts::getPageCount');
       $routes->get('post/getPageCount/(:num)/', 'admin\Posts::getPageCount/$1');
       $routes->get('post/getPageCount/(:num)', 'admin\Posts::getPageCount/$1');
       $routes->get('post/editor', 'admin\Posts::new');
       $routes->get('post/editor/(:num)', 'admin\Posts::new/$1');
       $routes->post('post/store', 'admin\Posts::store');
       $routes->post('post/upload', 'admin\Posts::upload');
       $routes->post('post/delete', 'admin\Posts::delete');

    //    $routes->get('inject/store', 'admin\Injects::store');

        //page route
        $routes->get('page', 'admin\Pages');
        $routes->get('page/(:num)', 'admin\Pages/$1');
        $routes->get('page/getAllPage', 'admin\Pages::getAllPage');
        $routes->get('page/getAllPage/(:num)', 'admin\Pages::getAllPage/$1');
        $routes->get('page/getPageCount', 'admin\Pages::getPageCount');
        $routes->get('page/getPageCount/(:num)/', 'admin\Pages::getPageCount/$1');
        $routes->get('page/getPageCount/(:num)', 'admin\Pages::getPageCount/$1');
        $routes->get('page/editor', 'admin\Pages::new');
        $routes->get('page/editor/(:num)', 'admin\Pages::new/$1');
        $routes->post('page/store', 'admin\Pages::store');
        $routes->post('page/upload', 'admin\Pages::upload');
        $routes->post('page/delete', 'admin\Pages::delete');

         //banner route
         $routes->get('banner', 'admin\Banners');
         $routes->get('banner/(:num)', 'admin\Banners/$1');
         $routes->get('banner/getAllBanner', 'admin\Banners::getAllBanner');
         $routes->get('banner/getAllBanner/(:num)', 'admin\Banners::getAllBanner/$1');
         $routes->get('banner/getPageCount', 'admin\Banners::getPageCount');
         $routes->get('banner/getPageCount/(:num)/', 'admin\Banners::getPageCount/$1');
         $routes->get('banner/getPageCount/(:num)', 'admin\Banners::getPageCount/$1');
         $routes->get('banner/editor', 'admin\Banners::new');
         $routes->get('banner/editor/(:num)', 'admin\Banners::new/$1');
         $routes->post('banner/store', 'admin\Banners::store');
         $routes->post('banner/upload', 'admin\Banners::upload');
         $routes->post('banner/delete', 'admin\Banners::delete');

          //infograph route
          $routes->get('infograph', 'admin\Infographs');
          $routes->get('infograph/(:num)', 'admin\Infographs/$1');
          $routes->get('infograph/getAllInfograph', 'admin\Infographs::getAllInfograph');
          $routes->get('infograph/getAllInfograph/(:num)', 'admin\Infographs::getAllInfograph/$1');
          $routes->get('infograph/getPageCount', 'admin\Infographs::getPageCount');
           $routes->get('infograph/getPageCount/(:num)/', 'admin\Infographs::getPageCount/$1');
          $routes->get('infograph/getPageCount/(:num)', 'admin\Infographs::getPageCount/$1');
          $routes->get('infograph/editor', 'admin\Infographs::new');
          $routes->get('infograph/editor/(:num)', 'admin\Infographs::new/$1');
          $routes->post('infograph/store', 'admin\Infographs::store');
          $routes->post('infograph/upload', 'admin\Infographs::upload');
          $routes->post('infograph/delete', 'admin\Infographs::delete');

         //menu route
         $routes->get('menu', 'admin\Menus');
         $routes->get('menu/(:num)', 'admin\Menus/$1');
         $routes->get('menu/getAllMenu', 'admin\Menus::getAllMenu');
         $routes->get('menu/getPageCount', 'admin\Menus::getPageCount');
          $routes->get('menu/getPageCount/(:num)/', 'admin\Menus::getPageCount/$1');
         $routes->get('menu/getPageCount/(:num)', 'admin\Menus::getPageCount/$1');
         $routes->get('menu/editor', 'admin\Menus::new');
         $routes->get('menu/editor/(:num)', 'admin\Menus::new/$1');
         $routes->post('menu/store', 'admin\Menus::store');
         $routes->post('menu/upload', 'admin\Menus::upload');
         $routes->post('menu/delete', 'admin\Menus::delete');

          //landing menu route
          $routes->get('landingmenu', 'admin\LendingMenus');
          $routes->get('landingmenu/(:num)', 'admin\LendingMenus/$1');
          $routes->get('landingmenu/getAllLendingMenu', 'admin\LendingMenus::getAllLendingMenu');
          $routes->get('landingmenu/getPageCount', 'admin\LendingMenus::getPageCount');
          $routes->get('landingmenu/getPageCount/(:num)/', 'admin\LendingMenus::getPageCount/$1');
          $routes->get('landingmenu/getPageCount/(:num)', 'admin\LendingMenus::getPageCount/$1');
          $routes->get('landingmenu/editor', 'admin\LendingMenus::new');
          $routes->get('landingmenu/editor/(:num)', 'admin\LendingMenus::new/$1');
          $routes->post('landingmenu/store', 'admin\LendingMenus::store');
          $routes->post('landingmenu/upload', 'admin\LendingMenus::upload');
          $routes->post('landingmenu/delete', 'admin\LendingMenus::delete');


          //link route
        $routes->get('otherlink', 'admin\Otherlinks');
        $routes->get('otherlink/(:num)', 'admin\Otherlinks/$1');
        $routes->get('otherlink/getAllOtherLink', 'admin\Otherlinks::getAllOtherlink');
        $routes->get('otherlink/getAllOtherLink/(:num)', 'admin\Otherlinks::getAllOtherlink/$1');
        $routes->get('otherlink/getOtherLinkCount', 'admin\Otherlinks::getOtherlinkCount');
        $routes->get('otherlink/getOtherLinkCount/(:num)/', 'admin\Otherlinks::getOtherlinkCount/$1');
        $routes->get('otherlink/getOtherLinkCount/(:num)', 'admin\Otherlinks::getOtherlinkCount/$1');
        $routes->get('otherlink/editor', 'admin\Otherlinks::new');
        $routes->get('otherlink/editor/(:num)', 'admin\Otherlinks::new/$1');
        $routes->post('otherlink/store', 'admin\Otherlinks::store');
        $routes->post('otherlink/delete', 'admin\Otherlinks::delete');


        //media link route
        $routes->get('medialink', 'admin\Medialinks');
        $routes->post('medialink/store', 'admin\Medialinks::store');

        //sites setting route
        $routes->get('sitesetting', 'admin\Sitesettings');
        $routes->post('sitesetting/store', 'admin\Sitesettings::store');

         //User route
         $routes->get('user', 'admin\User');
         $routes->get('user/(:num)', 'admin\User/$1');
         $routes->get('user/getAllUser', 'admin\User::getAllUser');
         $routes->get('user/editor', 'admin\User::new');
         $routes->get('user/editor/(:num)', 'admin\User::new/$1');
         $routes->get('user/reset/(:num)', 'admin\User::resetUser/$1');
         $routes->post('user/store', 'admin\User::store');
         $routes->post('user/delete', 'admin\User::delete');

       //profile route
       $routes->get('user/profile', 'admin\User::profile');
       $routes->get('user/password', 'admin\User::password');
       $routes->post('user/profile', 'admin\User::update');
       $routes->post('user/password', 'admin\User::reset');


       //logout route
       $routes->get('logout', 'auth\Logout');
       
       
       // //setting route
       $routes->post('update/profile', 'admin\Setting::updateprofile');
       $routes->post('update/password', 'admin\Setting::resetpassword');

        
       
       
       //any undefinition url route to admin dashboard

       $routes->get('/', 'admin\Dashboard');
       $routes->addRedirect(':any', '/');

   } 

    $routes->get('logout', 'auth\Logout');

}

$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
