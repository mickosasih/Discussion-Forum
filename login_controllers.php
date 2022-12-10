<?php 
require_once('sess_auth.php');
require_once('./connection.php');
    date_default_timezone_set("Asia/Bangkok");
    
    if($_SERVER['REQUEST_METHOD'] === "POST" && !empty($_POST['username'])&& !empty($_POST['password'])){
        extract($_POST);

		$stmt = $conn->prepare("SELECT * from users where username = ? and password = ? ");
		$password = md5($password);
		$stmt->bind_param('ss',$username,$password);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['avatar'] = $row['avatar'];
            $_SESSION['lastLogin'] = time();
            $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['ipAddress'] =  getUserIp();
            header('Location: ./home.php');
		}else{
            $_SESSION['msg'] ="The username or password is incorrect";
            header('Location: ./login.php');
            die;
		}
    }else{
        header('Location: ./login.php');
        die;
    }
?>