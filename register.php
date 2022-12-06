<?php 
require_once('header.php');
require_once('validate_image.php');
    
    require_once('DBConnection.php');
    $db = new DBConnection;
    $conn = $db->conn;
    if($_SERVER['REQUEST_METHOD']==="POST" && !empty($_POST['fullname']) && !empty($_POST['username'])&& !empty($_POST['password'])){
		if(!empty($_POST['password']))
			$_POST['password'] = md5($_POST['password']);
		else
		unset($_POST['password']);
		extract($_POST);
		$data = "";
		$check = $conn->query("SELECT * FROM `users` where username = '{$username}' ")->num_rows;
		if($check > 0){
            echo "<div class='card'>Username already exists</div>";
		}
        else{
            foreach($_POST as $k => $v){
                $v = $conn->real_escape_string($v);
                if(!in_array($k, ['id']) && !is_array($_POST[$k])){
                    if(!empty($data)) $data .= ", ";
                    $data .= " `{$k}` = '{$v}' ";
                }
            }
            $sql = "INSERT INTO `users` set {$data} ";
            $save = $conn->query($sql);
            if($save){
                $uid = !empty($id) ? $id : $conn->insert_id;
                if(!empty($_FILES['avatar']['tmp_name'])){
                    $file_name = $_FILES['avatar']['name'];
                    $temp_file_path = $_FILES['avatar']['tmp_name'];
                    $new_file_path = "./uploads/avatars/$uid.png";
                    move_uploaded_file($temp_file_path, $new_file_path);
                    $fname = "uploads/avatars/$uid.png";
                    $conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}'");
                }
                echo "<div class='card'>Your Account has been created successfully</div>";
            }
            else{
                echo "<div class='card'>Failed to create account</div>";
            }
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
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="register_content">
            <h1 id="title_center">Create Account</h1><br>
            <div>
            <div id="have_account">
              <div id="img-preview"><label for="choose-file"><img src="./asset/user.png" alt=""></label></div>
              <input type="file" accept="image/png, image/jpeg" id="choose-file" name="avatar" />
            </div><br>
                <div>
                    <input type="text" name="fullname" id="input_text" placeholder="Fullname" required>
                </div><br>
                <div>
                    <input type="text" name="username" id="input_text" placeholder="Username" required>
                </div><br>
                <div>
                    <input type="password" name="password" id="input_text" placeholder="Password" required >
                </div><br>
            </div>
            <div>
                <button type="submit" id="login">Create Account</button>
            </div><br>
            </form>
            <a id="have_account"href="./login.php">Already have an Account?</a>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
  const chooseFile = document.getElementById("choose-file");
const imgPreview = document.getElementById("img-preview");
  chooseFile.addEventListener("change", function () {
  getImgData();
});
function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<label for="choose-file"><img src="' + this.result + '" /></label>';
    });    
  }
}

</script>