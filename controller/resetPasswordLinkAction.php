<?php

include_once "dbController.php";

$conn = connectToDB();

$email = mysqli_escape_string($conn, $_SESSION['forgetEmail']);
$hash = mysqli_escape_string($conn, $_SESSION['hash']);

if( ($email == "") || ($hash == ""))
{
    header("Location: http://www.squaducsd.com/error.php");
    exit();
}

$sql = "SELECT * FROM student WHERE email='$email' AND forgotPwdHash='$hash'";
$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)) {
    // No match -> Invalid or expired reset password link.
    header("Location: http://www.squaducsd.com/error.php");
}
?>
<!-- stop PHP Code -->

