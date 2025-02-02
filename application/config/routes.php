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
$route['tasks/edit/(:num)'] = 'api/tasks/update_task/$1';

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
 * 1. data barang
 */
$route['datatask'] = 'admin/cmasterdata/datatask';
$route['tambahtask'] = 'admin/cmasterdata/tambahtask';
$route['simpantask'] = 'admin/cmasterdata/simpantask';
$route['edittask/(:num)'] = 'admin/cmasterdata/edit/$1';
$route['updatetask'] = 'admin/cmasterdata/update';
$route['hapustask'] = 'admin/cmasterdata/delete';

/**
 * MENU Master Data
 * 1. data supplier
 */
$route['supplier'] = 'admin/cmasterdata/supplier';
$route['tambahsuplier'] = 'admin/cmasterdata/tambahsuplier';
$route['simpansuplier'] = 'admin/cmasterdata/simpansuplier';
$route['editsuplier/(:num)'] = 'admin/cmasterdata/editsuplier/$1';
$route['updatesuplier'] = 'admin/cmasterdata/updatedatasuplier';
$route['hapussuplier'] = 'admin/cmasterdata/hapussuplier';

/**
 * 2. data produk
 */
$route['produk'] = 'admin/cmasterdata/dataproduk';
$route['tambahproduk'] = 'admin/cmasterdata/tambahproduk';
$route['simpanproduk'] = 'admin/cmasterdata/simpanproduk';
$route['editproduk/(:num)'] = 'admin/cmasterdata/editproduk/$1';
$route['updateproduk'] = 'admin/cmasterdata/updatedataproduk';
$route['hapusproduk'] = 'admin/cmasterdata/hapusproduk';

/**
 * 3. data buyer
 */
$route['buyer'] = 'admin/cmasterdata/databuyer';
$route['tambahbuyer'] = 'admin/cmasterdata/tambahbuyer';
$route['simpanbuyer'] = 'admin/cmasterdata/simpanbuyer';
$route['editbuyer/(:num)'] = 'admin/cmasterdata/editbuyer/$1';
$route['updatebuyer'] = 'admin/cmasterdata/updatedatabuyer';
$route['hapusbuyer'] = 'admin/cmasterdata/hapusbuyer';

/**
 * MENU Inventory 
 * 1. Stok Barang
 */
$route['stokbarang'] = 'admin/cinventory/stokbarang';
$route['tambahstokbarang'] = 'admin/cinventory/tambahstokbarang';
$route['simpanstokbarang'] = 'admin/cinventory/simpanstokbarang';
$route['editstokbarang/(:num)'] = 'admin/cinventory/editstokbarang/$1';
$route['updatestokbarang'] = 'admin/cinventory/updatestokbarang';
$route['deletestokbarang'] = 'admin/cinventory/deletestokbarang';


/**
 * MENU Inventory 
 * 2. Barang Masuk
 */
$route['barangmasuk'] = 'admin/cinventory/barangmasuk';
$route['tambahbarangmasuk'] = 'admin/cinventory/tambahbarangmasuk';
$route['simpanbarangmasuk'] = 'admin/cinventory/simpanbarangmasuk';
$route['editbarangmasuk/(:num)'] = 'admin/cinventory/editbarangmasuk/$1';
$route['updatebarangmasuk'] = 'admin/cinventory/updatebarangmasuk';
$route['deletebarangmasuk'] = 'admin/cinventory/deletebarangmasuk';

/**
 * MENU Inventory 
 * 2. Barang Keluar
 */
$route['barangkeluar'] = 'admin/cinventory/barangkeluar';
$route['tambahbarangkeluar'] = 'admin/cinventory/tambahbarangkeluar';
$route['simpanbarangkeluar'] = 'admin/cinventory/simpanbarangkeluar';
$route['editbarangkeluar/(:num)'] = 'admin/cinventory/editbarangkeluar/$1';
$route['updatebarangkeluar'] = 'admin/cinventory/updatebarangkeluar';
$route['deletebarangkeluar'] = 'admin/cinventory/deletebarangkeluar';


/**
 * MENU Transaksi 
 * 2. pembelian barang
 */
$route['pembelianbarang'] = 'admin/ctransaksi/pembelian';
$route['tambahpembelian'] = 'admin/ctransaksi/tambahpembelian';
$route['simpanpembelian'] = 'admin/ctransaksi/simpanpembelian';
$route['editpembelian/(:num)'] = 'admin/ctransaksi/editpembelian/$1';
$route['updatepembelian'] = 'admin/ctransaksi/updatepembelian';
$route['hapuspembelian'] = 'admin/ctransaksi/deletepembelian';

/**
 * MENU Transaksi 
 * 2. Penjualan barang
 */
$route['penjualanbarang'] = 'admin/ctransaksi/penjualanbarang';
$route['tambahpenjualan'] = 'admin/ctransaksi/tambahpenjualan';
$route['simpanpenjualan'] = 'admin/ctransaksi/simpanpenjualan';
$route['editpenjualan/(:num)'] = 'admin/ctransaksi/editpenjualan/$1';
$route['updatepenjualan'] = 'admin/ctransaksi/updatepenjualan';
$route['hapuspenjualan'] = 'admin/ctransaksi/deletepenjualan';
$route['buyer_penjualan'] = 'admin/ctransaksi/buyer_penjualan';
/**
 * LOGIN
 */
$route['adminlogin'] = 'cauth/login';
$route['adminlogout'] = 'cauth/logout';
