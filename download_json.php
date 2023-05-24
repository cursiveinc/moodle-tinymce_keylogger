<?php
$resourceId=$_GET['resourceId'];
$user_id=$_GET['user_id'];
$cmid=$_GET['cmid'];

        $dirname = __DIR__ .'/userdata/';     
        $filename = $dirname. $user_id.'_'.$resourceId.'_'.$cmid.'_attempt'.'.json';
        header("Content-Description: File Transfer"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Disposition: attachment; filename=\"". basename($filename) ."\""); 
        flush();
        $inp = file_get_contents($filename);
        echo $inp;
        die();

?>