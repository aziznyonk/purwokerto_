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
/*
| -------------------------------------------------------------------------
| Web Service Routes
| -------------------------------------------------------------------------
*/
$route['default_controller']        = 'login';
$route['404_override']              = 'error_404';
$route['translate_uri_dashes']      = TRUE;

$route['loginMe']                   = 'login/loginMe';

$route['dashboard']                 = 'dashboard';

$route['user']                      = 'user';
$route['addUser']                   = 'userAdd';
$route['insertOneUser']             = 'userAdd/insertOneUser';
$route['add50User']                 = 'userAdd/add50User';

$route['logout']                    = 'user/logout';

$route['mbr']                       = 'sr_mbr';
$route['mbr/getDataPelMbr']         = 'sr_mbr/getDataPelMbr';
$route['mbr/getDataPelId']          = 'sr_mbr/getDataPelId';
$route['mbr/update_pelanggan']      = 'sr_mbr/update_pelanggan';
$route['addMbr']                    = 'sr_mbrAdd';
$route['insertOneMbr']              = 'sr_mbrAdd/insertOneMbr';
$route['delete_mbr']                = 'sr_mbr/delete_mbr';

$route['admin']                     = 'admin';
$route['addAdmin']                  = 'addAdmin';
$route['insertOneAdmin']            = 'addAdmin/insertOneAdmin';

$route['pela']                      = 'pela';
$route['delete_pelanggan']          = 'pela/delete_pelanggan';

$route['news']                      = 'news';

$route['pipa']                      = 'pipa';
$route['pipa/details_pipa/(:num)']  = 'pipa/details_pipa/$1';
$route['pipaRencana']               = 'pipa/pipaRencana';
$route['pipaRencanaAdd']            = 'pipa/pipaRencanaAdd';
$route['pipaRencanaCreate']         = 'pipa/pipaRencanaCreate';

$route['exportKml_pela']            = 'kml_pwt/export_pela';
$route['exportKml_mbr']             = 'kml_pwt/export_mbr';
$route['exportKml_pipa']            = 'kml_pwt/export_pipa';

$route['tekanan']                           = 'manometer';
$route['tekanan/getDetailTekanan/(:num)']   = 'manometer/getDetailTekanan/$1';
$route['tekanan/update/(:num)']             = 'manometer/update/$1';
$route['tekanan/delete/(:num)']             = 'manometer/delete/$1';
$route['tekanan/getDataTekanan']            = 'manometer/getDataTekanan';
$route['tekanan/details_pipa/(:num)']       = 'manometer/details_pipa/$1';
$route['tekanan/getMap/(:any)/(:any)']      = 'manometer/getMap/$1/$2';
$route['master_tekanan']                    = 'MasterTekanan';

/*ini route bagian WEB GIS*/
$route['maps']                      = 'map';
$route['mapsManometer']             = 'map/mapManometer';
$route['mapsMeter']                 = 'map/mapMeter';
$route['mapsVelve']                 = 'map/mapVelve';
$route['mapsPelanggan']             = 'map/mapPelanggan';
$route['mapsSearchPelanggan']       = 'map/mapSearchPelanggan';
$route['mapsMbr']                   = 'map/mapMbr';
$route['mapsPipaRencana']           = 'map/mapPipaRencana';
$route['mapsPipa']                  = 'map/mapPipa';
$route['mapsDop']                   = 'map/mapDop';
$route['mapsFhydrant']              = 'map/mapFhydrant';
$route['mapsGiboult']               = 'map/mapGiboult';
$route['mapsJembatan']              = 'map/mapJembatan';
$route['mapsKnie']                  = 'map/mapKnie';
$route['mapsPompa']                 = 'map/mapPompa';
$route['mapsTee']                   = 'map/mapTee';

/*ini route bagian WEB GIS TEKANAN DAN DEBIT*/
$route['mapsTekanan']               = 'map/mapTekanan';
//$route['mapsTekanan']			= 'mapTekanan';
$route['mapsPipaTekanans']          = 'mapTekanan/mapTekanans';
$route['mapsTekananCek']            = 'mapTekanan/mapsTekananCek';
$route['mapsManometerCek']          = 'mapTekanan/mapsManometer';
$route['mapsMeterCek']              = 'mapTekanan/mapsMeter';
/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/
$route['api/loginMe']                   = 'API/LoginMe';
$route['api/insertSr_Mbr']              = 'API/insertSr_Mbr';
$route['api/getAllSr_mbr']              = 'API/getAllSr_mbr';
$route['api/getCountAllSr_mbrByUser']   = 'API/getCountAllSr_mbrByUser';
$route['api/getCountAllSr_mbr']         = 'API/getCountAllSr_mbr';
$route['api/searchSr_mbr']              = 'API/searchSr_mbr';
$route['api/insertPipaDetails']         = 'API/insertPipaDetails';
$route['api/getAllPipa']                = 'API/getAllPipa';
$route['api/insertK_Pelanggan']         = 'API/insertKoorPelanggan';
$route['api/searchPelanggan']           = 'API/searchPelanggan';
$route['api/getHotNews']                = 'API/getHotNews';
$route['api/getTekananMano']            = 'API/getTekananMano';
$route['api/getDebitMeter']             = 'API/getDebitMeter';
$route['api/insertAssets']              = 'API/insertAssets';

$route['api/insertPengawas']            = 'API/insertPengawas';
$route['api/searchPengawas']            = 'API/searchPengawas';

$route['api/getALLManometer']           = 'API/getALLManometer';
$route['api/searchManometer']           = 'API/searchManometer';
$route['api/insertTekananManometer']    = 'API/insertTekananManometer';
$route['api/searchMeterinduk']          = 'API/searchMeterinduk';
$route['api/insertDebitMeterinduk']     = 'API/insertDebitMeterinduk';
$route['api/insertDebitTekanan']        = 'API/insertDebitTekanan';
$route['api/insertManometer']           = 'API/insertManometer';
