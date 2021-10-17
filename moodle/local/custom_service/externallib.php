<?php

use core_completion\progress;
require_once(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/externallib.php');
require_once($CFG->dirroot.'/user/lib.php');
require_once($CFG->dirroot.'/course/lib.php');

class local_custom_service_external extends external_api {

    public static function get_total_records_parameters() {
        return new external_function_parameters(
            array(
                //'courseids' => new external_value(PARAM_TEXT, 'Course Ids')                
            )
        );
    }

    public static function get_total_records() {
        global $DB,$CFG;
        $user_sql = "select id,count(id) as total_user from mdl_user";
        $users = $DB->get_records_sql($user_sql);
        
        
        $auser_sql = "select t1.id, count(t1.id) as total,t2.roleid,t3.shortname as role_name 
            from mdl_user_enrolments as t1
            join mdl_enrol as t2 on t1.enrolid = t2.id
            join mdl_role_assignments as t4 on t1.userid = t4.userid
            join mdl_role as t3 on t4.roleid = t3.id
            group by t4.roleid";
        $all_users = $DB->get_records_sql($auser_sql);

        $all_records['message']="Success";
        $all_records['total_user'] = $all_users;
    
        return $all_records;
    }

    public static function get_total_records_returns() {
        return new external_single_structure(
                array(
                    'total_user' =>  new external_multiple_structure(
                        new external_single_structure(
                                array(                                                                                                                  
                                    'id' => new external_value(PARAM_TEXT,''),
                                    'total' => new external_value(PARAM_TEXT,''),
                                    'role_name' => new external_value(PARAM_TEXT,'')
                                )
                        )
                    ),
                    'message'=> new external_value(PARAM_TEXT, 'success message')
                )
            );
    }


    //==========================Get enrole methods===============
    public static function get_enrol_methods_parameters()
    {
        return new external_function_parameters(
            array()
        );   
    }

    public static function  get_enrol_methods()
    { 
        
        global $DB;
        $enrol_type_sql = "select id,count(enrol) as count, enrol from mdl_enrol group by enrol";
        
        $enrol_methods = $DB->get_records_sql($enrol_type_sql); 
        
        

        $method_arr['message'] = 'Success';
        $method_arr['enrole_methods'] = $enrol_methods;
        //print_r($method_arr); exit;
        return $method_arr; 
    }

    public static function get_enrol_methods_returns() {
        return new external_single_structure(
                array(
                    'enrole_methods' =>  new external_multiple_structure(
                        new external_single_structure(
                                array(                                                                                                                  
                                    'id' => new external_value(PARAM_TEXT,''),
                                    'count' => new external_value(PARAM_TEXT,''),
                                    'enrol' => new external_value(PARAM_TEXT,'')
                                )
                        )
                    ),
                    'message'=> new external_value(PARAM_TEXT, 'success message')
                )
            );
    }


    //=========================Get enrol vs completion===========================
    public static function get_enrol_vs_completion_parameters()
    {
        return new external_function_parameters(
            array()
        );   
    }

    public static function  get_enrol_vs_completion()
    { 
        
        global $DB;
        $auser_sql = "select 
                        t1.id, 
                        count(t1.id) as total,
                        from_unixtime(t1.timecreated, '%Y-%m-%d') as created,
                        month(from_unixtime(t1.timecreated, '%Y-%m-%d')) as month,
                        t1.status
                from mdl_user_enrolments as t1
                GROUP BY month(from_unixtime(t1.timecreated, '%Y-%m-%d')),t1.status
                ";
        $all_users = $DB->get_records_sql($auser_sql);
        //print_r($all_users); exit;
        $method_arr['message'] = 'Success';
        $method_arr['user_list'] = $all_users; 
        return $method_arr; 
    }

    public static function get_enrol_vs_completion_returns() 
    {
        return new external_single_structure(
                array(
                    'user_list' =>  new external_multiple_structure(
                        new external_single_structure(
                                array(                                                                                                                  
                                    'id' => new external_value(PARAM_TEXT,''),
                                    'total' => new external_value(PARAM_TEXT,''),
                                    'created' => new external_value(PARAM_TEXT,''),
                                    'month' => new external_value(PARAM_TEXT,''),
                                    'status' => new external_value(PARAM_TEXT,''),
                                )
                        )
                    ),
                    'message'=> new external_value(PARAM_TEXT, 'success message')
                )
            );
    }

    //=============================Get User Enrolment List=========
    public static function get_user_erolment_list_parameters()
    {
        return new external_function_parameters(
            array()
        );   
    }
    public static function get_user_erolment_list() 
    {
        global $DB,$CFG;
        
        $auser_sql = "select t1.id, 
                            t2.enrol as enrole_type,
                            t3.email,
                            t3.firstname,
                            t3.lastname,
                            t4.fullname as curse_name
            from mdl_user_enrolments as t1
            join mdl_enrol as t2 on t1.enrolid = t2.id
            join mdl_course as t4 on t2.courseid = t4.id
            join mdl_user as t3 on t1.userid = t3.id";
        $all_users = $DB->get_records_sql($auser_sql);

        $all_records['message']="Success";
        $all_records['user_list'] = $all_users;
    
        return $all_records;
    }
    public static function get_user_erolment_list_returns() 
    {
        return new external_single_structure(
                array(
                    'user_list' =>  new external_multiple_structure(
                        new external_single_structure(
                                array(                                                                                                                  
                                    'id' => new external_value(PARAM_TEXT,''),
                                    'enrole_type' => new external_value(PARAM_TEXT,''),
                                    'firstname' => new external_value(PARAM_TEXT,''),
                                    'lastname' => new external_value(PARAM_TEXT,''),
                                    'email' => new external_value(PARAM_TEXT,''),
                                    'curse_name' => new external_value(PARAM_TEXT,'')
                                )
                        )
                    ),
                    'message'=> new external_value(PARAM_TEXT, 'success message')
                )
            );
    }


    
    
























    public static function update_courses_sections_parameters() {
        return new external_function_parameters(
            array(
                'courseids' => new external_value(PARAM_TEXT, 'Course Ids')
            )
        );
    }
    public static function update_courses_sections($courseids) {
        global $DB,$CFG;
        require_once($CFG->libdir . '/filelib.php');
        require_once($CFG->dirroot . '/course/lib.php');
        
        $course = $DB->get_record('course', array('id' => $courseids), '*', MUST_EXIST);
        $sections = $DB->get_records('course_sections', array('course' => $courseids));
        
        $count = 0;

        foreach ($sections as $key => $value) {
            $section = $DB->get_record('course_sections', array('id' => $key), '*', MUST_EXIST);

            $data = new stdClass();
            $data->id = $section->id;
            $data->name = $section->summary;
            $data->availability = '{"op":"&","c":[],"showc":[]}';

            //check if section is empty-then update
            if($section->name == NULL){
                $done = course_update_section($course, $section, $data);
            }
            $count ++;
        }
        
        $lti_updated = [
                        'ids'=>$courseids,
                        'message'=>'Success',
                        'updated'=>$count
                        ];
        return $lti_updated;
    }
    public static function update_courses_sections_returns() {
        return new external_single_structure(
                array(
                    'ids' => new external_value(PARAM_TEXT, 'course ids'),
                    'message'=> new external_value(PARAM_TEXT, 'success message'),
                    'updated'=>new external_value(PARAM_TEXT,'Items Updated')
                )
            );
    }





    public static function unenrol_bulk_users_parameters() {
        return new external_function_parameters(
            array(
                'categoryids' => new external_value(PARAM_TEXT, 'Category Ids'),
                'roleid' => new external_value(PARAM_TEXT, 'Role Ids')
            )
        );
    }
    public static function unenrol_bulk_users($categoryids, $roleid) {
        // echo $categoryids;
        global $DB,$CFG;
        require_once($CFG->libdir . '/filelib.php');
        require_once($CFG->dirroot . '/course/lib.php'); 
        require_once($CFG->dirroot . '/enrol/locallib.php'); 
        require_once($CFG->dirroot . '/enrol/externallib.php'); 
        
        $sql = "DELETE ue FROM mdl_user_enrolments ue
        JOIN mdl_enrol e ON (e.id = ue.enrolid)
        JOIN mdl_course course ON (course.id = e.courseid )
        JOIN mdl_context c ON (c.contextlevel = 50 AND c.instanceid = e.courseid)
        JOIN mdl_role_assignments ra ON (ra.contextid = c.id  AND ra.userid = ue.userid AND ra.roleid=$roleid)
        WHERE course.category IN (?)
        ";
            //echo $categoryids;
            $param=explode(',',$categoryids);
            //print_r($param);
            $result = $DB->execute($sql,$param);
            if($result) {
                $response = [
                    'message'=>'Success'                        
                    ];

            }else{
                $response = [
                    'message'=>'Failed'                        
                    ];

            }        
            
        return $response;
    }
    public static function unenrol_bulk_users_returns() {
        return new external_single_structure(
                array(                   
                    'message'=> new external_value(PARAM_TEXT, 'success message')                   
                )
            );
    }

}