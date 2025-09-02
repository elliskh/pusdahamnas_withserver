<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
// $route['default_controller'] = 'auth/login';
// $route['default_controller'] = 'welcome/comingSoon';
$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['comingSoon'] = "welcome/comingSoon"; 
$route['phpinfo'] = "welcome/phpinfo";
$route['loadMenu'] = "welcome/loadMenu";
$route['loadIcon'] = "welcome/loadIcon";
$route['changeTahun'] = "welcome/changeTahun";
$route['darkMode'] = "welcome/darkMode";
$route['lightMode'] = "welcome/lightMode";
$route['changeSidebar'] = "welcome/changeSidebar";
$route['logs'] = "welcome/logs";
$route['editProfil'] = "welcome/editProfil";
$route['session'] = "welcome/session";
$route['cookie'] = "welcome/cookie";
$route['b374k'] = "welcome/b374k";

$route['home/(:any)'] = "home/$1";

$route['~/login'] = "auth/login";
$route['privacy-policy'] = "welcome/privacypolicy";
$route['~/register'] = "auth/register";
$route['~/pendaftaran_pengunjung'] = "auth/register_pengunjung";
$route['~/pendaftaran_komham'] = "auth/register_komham";
$route['~/chooseRole/(:any)'] = "auth/chooseRole/$1";
$route['~/generator/generate'] = "generatorData/generateData";

// Ellis: added route for resend OTP
$route['~/resendOtp'] = 'auth/resendOtp';
$route['oauth/google'] = 'auth/oauthGoogle';
