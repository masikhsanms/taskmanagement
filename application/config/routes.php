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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'admin/coverview';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * MENU DASHBOARD
 */
$route['admin'] = 'admin/coverview';

/** API */
$route['register']  = 'api/register';
$route['login']     = 'api/login';
$route['tasks']     = 'api/tasks';
$route['tasks/all'] = 'api/tasks/all';
$route['tasks/(:num)'] = 'api/tasks/get_task/$1';
$route['tasks/(:num)/edit'] = 'api/tasks/update_task/$1';
$route['tasks/(:num)/delete'] = 'api/tasks/delete_task/$1';
$route['tasks/(:num)/upload'] = 'api/tasks/uploadfile_task/$1';
$route['tasks/(:num)/preview'] = 'api/tasks/preview_task/$1';
/**
 * MENU PENGGUNA
 */
$route['pengguna'] = 'admin/cpengguna/pengguna';
$route['tambahpengguna'] = 'admin/cpengguna/tambah';
$route['simpanpengguna'] = 'admin/cpengguna/simpanpengguna';
$route['editpengguna/(:num)'] = 'admin/cpengguna/editpengguna/$1';
$route['updatepengguna'] = 'admin/cpengguna/updatepengguna';
$route['hapuspengguna'] = 'admin/cpengguna/hapuspengguna';


/**
 * MENU Master Data
 */
$route['datatask'] = 'admin/cmasterdata/datatask';
$route['tambahtask'] = 'admin/cmasterdata/tambahtask';
$route['simpantask'] = 'admin/cmasterdata/simpantask';
$route['edittask/(:num)'] = 'admin/cmasterdata/edit/$1';
$route['updatetask'] = 'admin/cmasterdata/update';
$route['hapustask'] = 'admin/cmasterdata/delete';


/**
 * LOGIN
 */
$route['adminlogin'] = 'cauth/login';
$route['adminlogout'] = 'cauth/logout';
