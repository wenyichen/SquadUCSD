<?php

include_once "dbController.php";
include_once "loginController.php";
include_once "viewProfileController.php";
include_once "leaveGroupController.php";

session_start();

handleNotLoggedIn();

// establish connection to the database
$conn = connectToDB();

$groupid = $_SESSION['groupid'];
$id = getUserId();
$group = getGroupObject($groupid);

$inGroup = $group->hasUser($id);

$disbanded = false;
// if somehow the user editing is not in the group, redirect to view profile page
if (!$inGroup)
    header("Location: http://www.squaducsd.com/viewgroup.php?groupid=$groupid");
else {


    $currGroupSize = $group->getSize();
    // if the group only has 2 people left
    if ($currGroupSize <= 2) {
        removeAllUsersInroup($conn, $groupid, $group);

        // disband the group
        disbandGroup($conn, $groupid);
        $disbanded = true;
    } else {
        // remove the groupid from the student table
        removeGroupFromUser($conn, $id, $groupid);

        // remove the user from the groupProfile table
        removeUserFromGroup($conn, $id, $groupid, $currGroupSize);
    }
}

if ($disbanded)
    header("Location: http://www.squaducsd.com/managegroups.php?disbanded");
else
    header("Location: http://www.squaducsd.com/managegroups.php?leave");
