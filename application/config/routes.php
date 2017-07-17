<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome/index';

$route['login'] = 'auth/login';
$route['dashboard'] = 'welcome/index';
$route['profile'] = 'profile/index';
$route['profile/account/save'] = 'profile/update_account';
$route['profile/file/save'] = 'profile/update_file';
$route['profile/password/save'] = 'profile/update_password';

// Masterlink
$route['masterlink'] = 'masterlink/index';
$route['masterlink/create'] = 'masterlink/create';
$route['masterlink/store'] = 'masterlink/store';
$route['masterlink/show/(:num)'] = 'masterlink/show/$1';
$route['masterlink/edit/(:num)'] = 'masterlink/edit/$1';
$route['masterlink/update/(:num)'] = 'masterlink/update/$1';
$route['masterlink/delete/(:num)'] = 'masterlink/delete/$1';
$route['masterlink/set_status'] = 'masterlink/set_status';

// Partnerlink
$route['partnerlink'] = 'partnerlink/index';
$route['partnerlink/create'] = 'partnerlink/create';
$route['partnerlink/store'] = 'partnerlink/store';
$route['partnerlink/show/(:num)'] = 'partnerlink/show/$1';
$route['partnerlink/edit/(:num)'] = 'partnerlink/edit/$1';
$route['partnerlink/update/(:num)'] = 'partnerlink/update/$1';
$route['partnerlink/delete/(:num)'] = 'partnerlink/delete/$1';
$route['partnerlink/set_status'] = 'partnerlink/set_status';

// Students
$route['students'] = 'student/index';
$route['students/create'] = 'student/create';
$route['students/store'] = 'student/store';
$route['students/show/(:num)'] = 'student/show/$1';
$route['students/edit/(:num)'] = 'student/edit/$1';
$route['students/update/(:num)'] = 'student/update/$1';
$route['students/delete/(:num)'] = 'student/delete/$1';
$route['students/set_status'] = 'student/set_status';

// Transfer
$route['transfer'] = 'transfer/index';
$route['transfer/create'] = 'transfer/create';
$route['transfer/store'] = 'transfer/store';
$route['transfer/show/(:num)'] = 'transfer/show/$1';
$route['transfer/edit/(:num)'] = 'transfer/edit/$1';
$route['transfer/update/(:num)'] = 'transfer/update/$1';
$route['transfer/delete/(:num)'] = 'transfer/delete/$1';
$route['transfer/set_status'] = 'transfer/set_status';

// Points
$route['point'] = 'point/index';

// Settings
$route['settings'] = 'setting/index';
$route['settings/edit/(:num)'] = 'setting/edit/$1';
$route['settings/update/(:num)'] = 'setting/update/$1';

//Parents
$route['parents/store'] = 'family/store';
$route['parents/update'] = 'family/update';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
