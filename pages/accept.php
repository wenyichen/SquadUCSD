<?php
// wrapper page for creating groups (the controller) to avoid that layer violation relax
// to be finished


$id1 = $_GET['id1'];
$id2 = $_GET['id2'];
$hash = $_GET['hash'];

include_once "../controller/createGroupAction.php";

if ($valid) {
    header("Location: ./managegroups.php?formed");
} else {
    // redirects to error page
    // for now it's going to redirect to the home page
    header("Location: ./error.php");
}

?>