<?php 

function get_user_attempts_data($userid, $courseid, $moduleid, $orderby='id', $order='ASC') { 
    $attempts=[];   
    global $DB;
    if($orderby == 'id'){
        $odby = 'u.id';
    }
    if($orderby == 'name'){
        $odby = 'u.firstname'; 
    }
    if($orderby == 'email'){
        $odby = 'u.email';
    }
    if($orderby == 'date'){
        $odby = 'qa.timemodified';
    }
    $attempts = "SELECT qa.resourceid as attemptid,qa.timemodified, u.id as userid, u.firstname, u.lastname, u.email,  qa.cmid as cmid FROM {user} u 
        INNER JOIN {tiny_keylooger_files} qa ON u.id = qa.userid  
        WHERE qa.userid!=1";
    if($userid != 0){
       $attempts .= " AND  qa.userid = $userid";
    }
    if ($courseid != 0) {
        $attempts .= "  AND qa.courseid=$courseid";
    }

    if ($moduleid != 0) {
        $attempts .= "  AND qa.cmid=$moduleid";
    }

    $attempts .= " ORDER BY $odby $order";

    $res = $DB->get_records_sql($attempts);
  
    return $res;
        
    
}


?>