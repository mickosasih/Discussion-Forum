<?php 
function getUserIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
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
if(!isset($_SESSION['id']) && !strpos($link, 'login.php') && !strpos($link, 'home.php') && !strpos($link, 'view_post.php') && !strpos($link, 'header.php') && !strpos($link, 'register.php')){
	header('Location: ./login.php');
}
if(isset($_SESSION['id']) && strpos($link, 'login.php')){
	header('Location: ./home.php');
}
if(isset($_SESSION['id']) && strpos($link, 'sess_auth.php')){
	header('Location: ./home.php');
}
if(isset($_SESSION['id'])){
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
    if (!isset($_SESSION['CREATED'])) {
        $_SESSION['CREATED'] = time();
    } else if (time() - $_SESSION['CREATED'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['CREATED'] = time();
    }
}