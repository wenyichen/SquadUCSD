<?php

// absolute max possible size for all groups
// modifiable
$MAX_GROUP_SIZE = 15;

$MIN_PWD_SIZE = 6;

$MAX_PWD_SIZE = 12;

$MAX_EMAIL_SIZE = 60;

// front end checks for 500 characters max, but some unicode takes 4 bytes per character
// e.g., korean characters
$UNICODE_BYTES = 4;

$MAX_MESSAGE_SIZE = 505 * $UNICODE_BYTES;

$MAX_NAME_SIZE = 45 * $UNICODE_BYTES;

$MAX_CLASS_NAME = 45 * $UNICODE_BYTES;

$MAX_GROUP_NAME = 45 * $UNICODE_BYTES;

$MAX_MAJOR_NAME = 45 * $UNICODE_BYTES;

$MAX_PHONE_SIZE = 15;

$MAX_ABOUT_SIZE = 1005 * $UNICODE_BYTES;

$MAX_QUERY_SIZE = 100 * $UNICODE_BYTES;

// this function clears all the flags in an url, after and including &
function clearFlags($url)
{
    $pos = strpos($url, "&");

    // no flag in found
    if($pos === false)
        return $url;

    return substr($url, 0, $pos);

}