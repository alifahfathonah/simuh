<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Auth';
$route['404_override'] = 'Error404';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'Auth/index';
$route['sign'] = 'Auth/login';
$route['logout'] = 'Auth/logout';

$route['dashboard'] = 'Dashboard/index';

$route['pendaftaranjamaah'] = 'PendaftaranJamaah/index';
$route['formpendaftaranjamaah'] = 'PendaftaranJamaah/add';
$route['simpanpendaftaranjamaah'] = 'PendaftaranJamaah/tambahJamaah';
$route['deletependaftaranjamaah/(:any)'] = 'PendaftaranJamaah/deletePendaftarJamaah/$1';

$route['paket'] = 'Paket/index';
$route['pakettampildata'] = 'Paket/tampilData';
$route['pakettampildatadetail'] = 'Paket/tampilDataDetail';
$route['formpaket'] = 'Paket/add';
$route['formdetailpaket/(:any)'] = 'Paket/edit/$1';
$route['tambahpaket'] = 'Paket/tambahPaket';
$route['deletepaket'] = 'Paket/deletePaket';

$route['approval'] = 'Approval/index';
$route['formapproval/(:any)'] = 'Approval/detailApproval/$1';
$route['tolakapproval'] = 'Approval/tolakApproval';
$route['setujuiapproval'] = 'Approval/disetujuiApproval';
// $route['printapproval/(:any)'] = 'Approval/printApproval/$1';
// $route['simpanapproval'] = 'Approval/tambahJamaah';
// $route['deleteapproval/(:any)'] = 'Approval/deletePendaftarJamaah/$1';

$route['datahotelmakkah'] = 'Hotel/tampilDataMakkah';
$route['datahotelmadina'] = 'Hotel/tampilDataMadina';
$route['tambahhotel'] = 'Hotel/tambahHotel';

$route['datakamar'] = 'Kamar/tampilData';
$route['tambahkamar'] = 'Kamar/tambahKamar';

$route['datamaskapai'] = 'Maskapai/tampilData';
$route['tambahmaskapai'] = 'Maskapai/tambahMaskapai';

$route['datadetailpaket/(:any)'] = 'DetailPaket/tampilData/$1';
$route['tambahdetailpaket'] = 'DetailPaket/tambahDetailPaket';
$route['deletedetailpaket'] = 'DetailPaket/deleteDetailPaket';

$route['datamitra'] = 'Mitra/tampilData';
$route['datamitrabyid'] = 'Mitra/getDataById';

