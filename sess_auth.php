<?php 
require_once('getuserip.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['id']) && !strpos($link, 'login.php')){
	header('Location: ./login.php');
}
if(isset($_SESSION['id']) && strpos($link, 'login.php')){
    if (!isset($_SESSION['ipAddress']) || $_SESSION['ipAddress'] !== getUserIp()) {
        session_unset();
        session_destroy();
        header('Location: ./login.php');
    }
    if (!isset($_SESSION['userAgent']) || $_SESSION['userAgent'] !== $_SERVER['HTTP_USER_AGENT']) {
        session_unset();
        session_destroy();
        header('Location: ./login.php');
    }
    if (isset($_SESSION['lastLogin']) && (time() - $_SESSION['lastLogin'] > 43200)) {
        session_unset();
        session_destroy();
        header('Location: ./login.php');
    }
	header('Location: ./home.php');
}