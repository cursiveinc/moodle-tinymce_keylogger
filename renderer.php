<?php


/**
 * @package tiny_keylogger
 * @category tiny
 * @copyright  ELS <admin@elearningstack.com>
 * @author eLearningstack
 */

defined('MOODLE_INTERNAL') || die;
require_once('classes/forms/userreportform.php');
//require_once('lib.php');
$page = optional_param('page', 0, PARAM_INT);
require_login();
global $PAGE, $DB;

class tiny_keylogger_renderer extends plugin_renderer_base
{
    public function timer_report($users, $courseid)
    {
        global $CFG, $DB, $OUTPUT;
        $table = new html_table();
        $table->head = array('Attemptid', 'Full Name', 'Email', 'Module Name','Last modified', '');
        foreach ($users as $user) {
            $modinfo = get_fast_modinfo($courseid);
            $cm = $modinfo->get_cm($user->cmid);
            //print_r($cm->modname);
            $get_module_name = get_coursemodule_from_id($cm->modname, $user->cmid, 0, false, MUST_EXIST);
            // echo "<pre>" ;           
            // print_r($get_module_name->name) ;
            $row = [];
            $row[] = $user->attemptid;
            $row[] = $user->firstname . ' ' . $user->lastname;
            $row[] = $user->email;
            // $row[] = $user->cmid;
            $row[] = $get_module_name->name;
            $row[] = date("l jS \of F Y h:i:s A",$user->timemodified);
            $row[] = "<a href=" . '/moodle/lib/editor/tiny/plugins/keylogger/download_json.php?user_id=' . $user->userid . '&resourceId=' . $user->attemptid . '&cmid=' . $user->cmid . '&quizid=2id="export" role="button" class="btn btn-primary" style="margin-right:50px;" >' . "Download" . "</a>";
            $table->data[] = $row;
        }
        echo html_writer::table($table);
    }
}
