<?php

/**
 * Plugin webservices.
 *
 * @package     tiny_keylogger
 * @copyright   2023 Palinfocom
 * @author      Kuldeep singh <kuldeep@palinfocom.com>
 * @license     Commercial or proprietary
 */



$functions = array(
  
    'keylogger_json' => array(
        'classname'   => 'keylogger_json_func_data',
        'methodname'  => 'keylogger_json_func',
        'classpath'   => '/lib/editor/tiny/plugins/keylogger/externallib.php',
        'description' => 'generate JSON',
        'type'        => 'write',
        'ajax'        => true
    ),
    'keylogger_get_user_list' => array(
        'classname'   => 'keylogger_json_func_data',
        'methodname'  => 'get_user_list',
        'classpath'   => '/lib/editor/tiny/plugins/keylogger/externallib.php',
        'description' => 'get quiz list by course',
        'type'        => 'read',
        'ajax'        => true
    ),
    'keylogger_get_module_list' => array(
        'classname'   => 'keylogger_json_func_data',
        'methodname'  => 'get_module_list',
        'classpath'   => '/lib/editor/tiny/plugins/keylogger/externallib.php',
        'description' => 'get quiz list by course',
        'type'        => 'read',
        'ajax'        => true
    ),
    'keylogger_reports' => array(
        'classname'   => 'keylogger_json_func_data',
        'methodname'  => 'keylogger_reports_func',
        'classpath'   => '/lib/editor/tiny/plugins/keylogger/externallib.php',
        'description' => 'generate Reports for download',
        'type'        => 'write',
        'ajax'        => true
    )
    

);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.

$services = array(
    'keylogger_json_service' => array(
        'functions' => array(           
            'keylogger_json',
            'keylogger_reports',
            'keylogger_get_quizlist',
            'keylogger_get_module_list'
        ),
        'restrictedusers' => 0,
        'enabled'=>1
    )
);



