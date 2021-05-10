<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$active_record = TRUE;
$db_user=getenv('DB_USERNAME');
$db_pwd=getenv('DB_PASSWORD')
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => $db_user,
    'password' => $db_pwd,
    'database' => 'telehea2_telehealers_new',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'autoinit' => TRUE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
 