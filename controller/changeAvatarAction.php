<?php

include_once "dbController.php";
include_once "loginController.php";
include_once "changeAvatarController.php";

session_start();

handleNotLoggedIn();

$conn = connectToDB();

$userid = getUserId();
$target_dir = "$_SERVER[DOCUMENT_ROOT]/img/";

$filename = "";
// check if the user is using big browser
if($_FILES["filename"]["error"] == UPLOAD_ERR_OK)
    $filename = "filename";
// smaller browser
else if ($_FILES["filename2"]["error"] == UPLOAD_ERR_OK)
    $filename = "filename2";
else // something went wrong
    header("Location: http://www.squaducsd.com/editprofile.php?avatarfail");



$suffix = pathinfo($_FILES[$filename]["name"])["extension"];
$file_name = "user_" . $userid . "." . $suffix;
$target_str = $target_dir . $file_name;

// this line checks for a valid image
$validImage = getimagesize($_FILES[$filename]["tmp_name"]);

// check for the file size
$validSize = $_FILES[$filename]["size"] < 250000;

if (!$validImage)
    header("Location: http://www.squaducsd.com/editprofile.php?invalidimage");
else if (!$validSize)
    header("Location: http://www.squaducsd.com/editprofile.php?invalidsize");
else {
    unlink($target_str); // remove the original file if there exists one
    // put the file in the disk
    if (move_uploaded_file($_FILES[$filename]["tmp_name"], $target_str)) {
        // change permission
        chmod($target_str, 0777);

        // update the database
        updateUserProfile($conn, $userid, $file_name);

        header("Location: http://www.squaducsd.com/editprofile.php?avatarupdated");
    }
    else {
        header("Location: http://www.squaducsd.com/editprofile.php?avatarfail");
    }
}