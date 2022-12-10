<?php 
require_once('sess_auth.php');
require_once('header.php');
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
        <form action="./register_controllers.php" method="POST" enctype="multipart/form-data">
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