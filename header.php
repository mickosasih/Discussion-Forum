<?php 
function validate_image($file){
	if(!empty($file)){
        $ex = explode("?",$file);
        $file = $ex[0];
        $ts = isset($ex[1]) ? "?".$ex[1] : '';
		if(is_file(str_replace('\\','/',__DIR__).'/'.$file)){
			return "http://localhost/project/".$file.$ts;
        }
    }
}
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
</head>
<body>
    <div class="header">
        <div class="left">
            <div>
                <a href="./home.php"><img src="./asset/logo.png" alt="" id="beban"></a>
            </div>
            <div>
                <a href="./home.php" id="link">Home</a>
                <a href="./manage_post.php" id="link">Add Post</a>
            </div>
        </div>
        <?php if(isset($_SESSION['id'])): ?>
            <div class="right">
            <div class="login">
            <?php if(isset($_SESSION['avatar'])): ?>
                <a href="./login.php"><img src="<?php echo $_SESSION['avatar'] ?>" alt="UserPicture" id="UP"></a>
                <?php else: ?>
                    <a href="./login.php"><img src="./asset/user.png" alt="UserPicture" id="UP"></a>
                    <?php endif; ?>
                <p id="link"><?=strip_tags($_SESSION['fullname'])?></a>
            </div>
            <div class="register">
                <a href="<?= !isset($_SESSION['id']) ? "./register.php" : "./logout.php" ?>" ><?= !isset($_SESSION['id']) ? "Register" : "Logout" ?></a>
            </div>
        </div>
            <?php else: ?>
                <div class="right">
            <div class="login">
                <a href="./login.php" id="link">Login</a>
            </div>
            <div class="register">
                <a href="<?= !isset($_SESSION['id']) ? "./register.php" : "./logout.php" ?>" ><?= !isset($_SESSION['id']) ? "Register" : "Logout" ?></a>
            </div>
        </div>
                <?php endif; ?>
    </div>
</body>
</html>