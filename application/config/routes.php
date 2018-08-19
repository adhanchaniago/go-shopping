<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pembeli';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['masuk'] = 'auth/masuk';
$route['daftar'] = 'auth/daftar';