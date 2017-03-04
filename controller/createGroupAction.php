<?php
include_once 'dbController.php';
include_once 'createGroupController.php';

// extract values from the url

$sql = "SELECT * FROM inviteTable WHERE id1='$id1' AND id2='$id2' AND hash='$hash'";
$conn = connectToDB();
$result = mysqli_query($conn, $sql);

$valid = false;
// check if the invite exists in the inviteTable
if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);
    $valid = true;

    // delete that row from the inviteTable
    deleteRowInInviteTable($id1, $id2, $hash, $conn);

    // create a new group and put these 2 people in that group
    $groupid = createGroup($id1, $id2, $conn);

    // update the "group" field for both individuals in the students table
    updateUserProfiles($id1, $id2, $groupid, $conn);
}
