<?php

defined('MOODLE_INTERNAL') || die();
$functions = array(
    'local_custom_service_get_total_records' => array(
        'classname' => 'local_custom_service_external',
        'methodname' => 'get_total_records',
        'classpath' => 'local/custom_service/externallib.php',
        'description' => 'Get total records of user, cours and student',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_custom_service_get_enrol_methods' => array(
        'classname' => 'local_custom_service_external',
        'methodname' => 'get_enrol_methods',
        'classpath' => 'local/custom_service/externallib.php',
        'description' => 'Get enrolment methods',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_custom_service_get_user_erolment_list' => array(
        'classname' => 'local_custom_service_external',
        'methodname' => 'get_user_erolment_list',
        'classpath' => 'local/custom_service/externallib.php',
        'description' => 'Get enrolment methods',
        'type' => 'write',
        'ajax' => true,
    ),
    'local_custom_service_get_enrol_vs_completion' => array(
        'classname' => 'local_custom_service_external',
        'methodname' => 'get_enrol_vs_completion',
        'classpath' => 'local/custom_service/externallib.php',
        'description' => 'Get vs completion',
        'type' => 'write',
        'ajax' => true,
    )
    
);

$services = array(
    'AppliedLab Custom Services' => array(
        'functions' => array(
            'local_custom_service_get_total_records',
            'local_custom_service_get_enrol_methods',
            'local_custom_service_get_enrol_vs_completion',
            'local_custom_service_get_user_erolment_list'
        ),
        'restrictedusers' => 0,
        'enabled' => 1,
    )
);