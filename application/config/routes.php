<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'customer';


$route['404_override'] = 'errors/not_found';
$route['translate_uri_dashes'] = FALSE;