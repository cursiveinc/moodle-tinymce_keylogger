<?php
/**
 * Plugin webservices.
 *
 * @package     tiny_keylogger
 * @category    tiny
 * @copyright   eLearningstack
 * @author      Kuldeep singh <kuldeep@palinfocom.com>
 * @license     Commercial or proprietary
 */

require_once("$CFG->libdir/externallib.php");
use tiny_keylogger\tiny_keylogger_data;

class keylogger_json_func_data extends external_api {
	 public static function keylogger_json_func_is_allowed_from_ajax() {
        return true;
    }
    public static function keylogger_reports_func_is_allowed_from_ajax() {
        return true;
    }
        // Service for quizzes list.
    public static function get_user_list_is_allowed_from_ajax() {
            return true;
    }
    
    public static function get_user_list_returns() {
            return new external_value(PARAM_RAW, 'All quizzes');
    }
    
    public static function get_user_list_parameters() {
            return new external_function_parameters(
                array(
                    'page' => new external_value(PARAM_INT, '', false),
                    'courseid' => new external_value(PARAM_INT, 'Course id', false, 'course_detail')
                )
            );
    }
    
    public static function get_user_list($page, $courseid) {
            require_login();
            $params = self::validate_parameters(
                self::get_user_list_parameters(),
                array(
                    'page' => $page,
                    'courseid' => $courseid
                )
            );
            return json_encode(tiny_keylogger_data::get_courses_users($params));
    }

         // Service for quizzes list.
    public static function get_module_list_is_allowed_from_ajax() {
            return true;
    }
    
    public static function get_module_list_returns() {
            return new external_value(PARAM_RAW, 'All quizzes');
    }
    
    public static function get_module_list_parameters() {
            return new external_function_parameters(
                array(
                    'page' => new external_value(PARAM_INT, '', false),
                    'courseid' => new external_value(PARAM_INT, 'Course id', false, 'course_detail')
                )
            );
    }
    
    public static function get_module_list($page, $courseid) {
            require_login();
            $params = self::validate_parameters(
                self::get_user_list_parameters(),
                array(
                    'page' => $page,
                    'courseid' => $courseid
                )
            );
            return json_encode(tiny_keylogger_data::get_courses_modules($params));
    }


    public static function keylogger_json_func_returns() {
        return new external_value(PARAM_RAW, 'result');
    }
    public static function keylogger_reports_func_returns() {
        return new external_value(PARAM_RAW, 'result');
    }

    public static function keylogger_json_func_parameters() {
        return new external_function_parameters(
            array(       
                'resourceId' => new external_value(PARAM_INT, 0,  'resourceId'),
                'key' => new external_value(PARAM_RAW, 'key detail', false, 'key'),
                'keyCode' => new external_value(PARAM_RAW, 'key code ', false, 'keycode'),
                'event' => new external_value(PARAM_RAW, 'event', false, 'event'),
                'cmid'=>new external_value(PARAM_INT, 0,  'cmid'),
                'modulename'=>new external_value(PARAM_RAW, 'quiz',  'modulename'),
            )
        );
    }
    public static function keylogger_reports_func_parameters() {
        return new external_function_parameters(
            array(       
                'coursename' => new external_value(PARAM_INT, 0,  'coursename'),
                'quizname' => new external_value(PARAM_RAW, 'quizname detail', false, 'quizname'),
                'username' => new external_value(PARAM_RAW, 'username detail ', false, 'username')
            )
        );
    }

    public static function keylogger_json_func($resourceId = 0, $key = null, $keyCode = null, $event='keyUp',$cmid=0, $modulename='quiz') {
        require_login();
        global $USER, $SESSION, $DB;
        $params = self::validate_parameters(
            self::keylogger_json_func_parameters(),
            array(               
                'resourceId' => $resourceId,
                'key' => $key,
                'keyCode' => $keyCode,
                'event' => $event,
                'cmid'=>$cmid, 
                'modulename'=>$modulename,             
               
            )
        );
        $courseId=0;
        if ($resourceId==0) {
           $resourceId = $cmid;
        }
        $user_data=array('resourceId'=>$resourceId,'key'=>$key,'keyCode'=>$keyCode,'event'=>$event);
        if($cmid){
            $cm = $DB->get_record('course_modules', array('id'=> $cmid));
            $user_data["courseId"]=  $cm->course;
            $courseId=$cm->course;
        }
        else{
            $user_data["courseId"]=  0; 
        }

        //$user_data['unixTimestamp']=time(); //13 digit time 13 digits ("the number of milliseconds since the epoch").
        list($microseconds, $seconds) = explode(' ', microtime());
        $milliseconds = sprintf('%03d', round($microseconds * 1000));
        $timestamp_in_milliseconds = $seconds . $milliseconds;
        //echo $timestamp_in_milliseconds; //int value

        $user_data['unixTimestamp']= $timestamp_in_milliseconds ; //13 digit time 13 digits ("the number of milliseconds since the epoch").

        $user_data["clientId"]= "2df2e6fc-dac2-4706-ac1b-992fb3019343";
        $user_data["personId"]=  $USER->id;

        //$cmid
        $dirname = __DIR__ .'/userdata/';
        $fname=$USER->id.'_'.$resourceId.'_'.$cmid.'_attempt'.'.json';
        $filename = __DIR__ .'/userdata/'.$fname ;
        //insert in database

       

        if (file_exists($dirname)) {
            //echo "The directory $filename exists.";
        } else {
            mkdir( $dirname, 0755);
        }
        $inp = file_get_contents($filename);
        $tempArray = null;
        if($inp){
        $tempArray = json_decode($inp, true);
        array_push($tempArray, $user_data);
        }else{
            $tempArray[] = $user_data;
            $dataObj = new stdClass();
            $dataObj->userid = $USER->id;
            $dataObj->resourceid = $resourceId;
            $dataObj->cmid = $cmid;
            $dataObj->courseid = $courseId;
            $dataObj->timemodified = time();
            $dataObj->filename = $fname;
            $table = 'tiny_keylooger_files';
            $DB->insert_record($table, $dataObj);
        }


        $jsonData = json_encode($tempArray);

        if(is_array($tempArray)){
            file_put_contents($filename, $jsonData);
        }else{
        // echo "not an array".$jsonData;
        }

        return $filename;
    }
    public static function keylogger_reports_func($coursename = 0,$quizname = null, $username='keyUp') {
        require_login();
        global $USER, $SESSION, $DB;
        $params = self::validate_parameters(
            self::keylogger_reports_func_parameters(),
            array(               
                'resourceId' => $coursename,
                'key' => $quizname,
                'keyCode' => $username                           
            )
        );      
        return "keylogger reports";
    }
}

?>