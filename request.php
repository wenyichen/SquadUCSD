<?php
// wrapper page for requesting to join groups to avoid that layer violation relax
// to be finished

$id1 = $_GET['id'];
$groupid = $_GET['groupid'];
$hash = $_GET['hash'];

include_once "$_SERVER[DOCUMENT_ROOT]/controller/requestAction.php";

if ($valid) {
    header("Location: http://www.squaducsd.com/viewgroup.php?groupid=$groupid&accepted");
} else {
    // redirects to error page
    header("Location: http://www.squaducsd.com/error.php");
}

?>