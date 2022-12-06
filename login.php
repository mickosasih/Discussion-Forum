<?php 
require_once('header.php');
require_once('sess_auth.php');
require_once('getuserip.php');
    require_once('DBConnection.php');
    $db = new DBConnection;
    $conn = $db->conn;
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
            echo "<div class='card'>Login Failed</div>";
            session_unset();
            session_destroy();
		}
    }

    function set_userdata($field='',$value=''){
		if(!empty($field) && !empty($value)){
			$_SESSION['userdata'][$field]= $value;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="login_card">
    <form action="" method="POST">
            <div class="login_content">
                <h1 id="title_center">Login</h1>
                <div>
                <div>
                    <input type="text" name="username" id="input_text" placeholder="Username" required>
                </div><br>
                <div>
                    <input type="password" name="password" id="input_text" placeholder="Passsword" required>
                </div>
                </div>
                <button type="submit" id="login">Login</button>
            </div>
        </form>
    </div>
</body>
</html>