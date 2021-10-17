<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\MoodleRest;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $moodle;
    public function __construct()
    {
        //$this->middleware('auth');

        $this->moodle = new MoodleRest('http://localhost/moodle/webservice/rest/server.php', '0fd1cab0b82c119becc8e0cba7007243');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    
    public function get_total()
    {

        $this->moodle->setReturnFormat($this->moodle::RETURN_JSON);
        $total = $this->moodle->request('local_custom_service_get_total_records', array(),MoodleRest::METHOD_GET);
        return $total;

    }
    
    public function get_enrol_methods()
    {

        $this->moodle->setReturnFormat($this->moodle::RETURN_JSON);
        $methods = $this->moodle->request('local_custom_service_get_enrol_methods', array(),MoodleRest::METHOD_GET);
       
        $a = json_decode($methods);
        $new_array = [];
        $methods = $a->enrole_methods;    
        if($methods){
            foreach($methods as $item)
            {
                  $new_array[] = array(
                      'name'=>$item->enrol,
                      'y'=> (int)$item->count
                  ); 

            }
        }
        return $new_array;
    }

    function get_enrol_vs_completion()
    {
        $this->moodle->setReturnFormat($this->moodle::RETURN_JSON);
        $user_list = $this->moodle->request('local_custom_service_get_enrol_vs_completion', array(),MoodleRest::METHOD_GET);
        $js_user_list = json_decode($user_list);
        $user_list =  $js_user_list->user_list;

        $month_array = [];
        $data_array = [];
        $status_array = [];
        if($user_list)
        {
            foreach($user_list as $item)
            { 
                $month_array[$item->status][$item->month]=$item->month; 
                $data_array[$item->status][$item->month]=$item->total;   
                $status_array[$item->status] = $item->status;   
            }
        }

        $month_list = ['1','2','3','4','5','6','7','8','9','10','11','12'];
        //--Loops 12 months
        $all_points =  [];
        foreach($status_array as $st=>$satus)
        {
            $points = array();
            foreach($month_list as $k=>$val)
            {
                if(@$data_array[$st][$val]!=''){
                        $points[] = (int) @$data_array[$st][$val];
                }else{
                    $points[] = 0;
                }
            }
            $all_points[$satus] = $points;
        }

        return $all_points;
    }


    
    public function get_user_erolment_list()
    {

        $this->moodle->setReturnFormat($this->moodle::RETURN_JSON);
        $user_list = $this->moodle->request('local_custom_service_get_user_erolment_list', array(),MoodleRest::METHOD_GET);
        $js_user_list = json_decode($user_list);
        return $js_user_list->user_list;

    }
}
