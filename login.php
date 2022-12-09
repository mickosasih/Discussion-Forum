<?php 
require_once('header.php');
require_once('sess_auth.php');
date_default_timezone_set("Asia/Bangkok");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="./style.css">
    <?php if(isset($_SESSION['msg'])){?>
        <div class="card"><?=$_SESSION['msg']?></div>
    <?php 
unset($_SESSION['msg']);
}?>
</head>
<body>
    <div class="login_card">
    <form action="./login_controllers.php" method="POST">
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