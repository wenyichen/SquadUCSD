<?php
include_once 'logoutController.php';

session_start();

handleNotLoggedIn();

logout();