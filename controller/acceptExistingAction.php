<?php
include_once "dbController.php";
include_once "acceptExistingActionController.php";
include_once "generalLibrary.php";

$conn = connectToDB();

$sql = "SELECT * FROM inviteTable WHERE id1='$id1' AND id2='$id2' AND groupid='$groupid' AND hash='$hash'";
$result = mysqli_query($conn, $sql);

$valid = false;
// check if the request exists in the inviteTable
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // delete that row from the inviteTable
    deleteRowInInviteTable($id1, $id2, $groupid, $hash, $conn);

    // update the group row in the groupProfile table
    $result = updateGroupProfile($id2, $groupid, $MAX_GROUP_SIZE, $conn);

    // if updated group successfully (the group exists)
    if ($result) {
        // update the "group" field for both individuals in the students table
        updateUserProfiles($id2, $groupid, $conn);

        // send email to notify people in the group
        sendEmail($id2, $groupid);

        $valid = true;
    }
}
