<?php 
require_once('DBConnection.php');
require_once('header.php');
require_once('sess_auth.php');
$db = new DBConnection;
$conn = $db->conn;
date_default_timezone_set("Asia/Bangkok");
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `post_list` where id= '{$_GET['id']}' and user_id = '{$_SESSION['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }
    if(empty($user_id)){
        header('Location: ./home.php');
    }
}
if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['id'])){

    if(empty($_POST['id'])){
        $_POST['user_id'] = $_SESSION['id'];
    }

extract($_POST);
$data = "";
foreach($_POST as $k =>$v){
    if(!in_array($k,array('id'))){
        if(!empty($data)) $data .=",";
        $v = $conn->real_escape_string($v);
        $data .= " `{$k}`='{$v}' ";
    }
}
if(empty($id)){
    $sql = "INSERT INTO `post_list` set {$data} ";
}else{
        $sql = "UPDATE `post_list` set {$data} where id = '{$id}' ";
}
$save = $conn->query($sql);
if($save){
    if(empty($id)){
        echo "<div class='card'>New Post successfully saved</div>";
        $id = $conn->insert_id;
    }
    else
    echo "<div class='card'>Post successfully updated</div>";
    
}else{
    echo "<div class='card'>Failed</div>";
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
    <div>
        <h2 id="card-title"><?= !isset($id) ? "Add New Topic" : "Update Topic Details" ?></h2>
    </div>
        <div class="card">
            <div>
            <form action="" id="post-form" method="POST">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
                        <div class="form-group">
                            <label for="title" id="label">Title</label><br>
                            <input type="text" class="form-control rounded-0" placeholder="Title" name="title" id="input_text" value="<?= isset($title) ? $title : "" ?>">
                        </div>
                        <div class="form-group">
                            <label for="content" id="label">Content</label><br>
                            <textarea type="text" class="form-control rounded-0" placeholder="Write down your thoughts" name="content" id="content"><?= isset($content) ? $content : "" ?></textarea>
                        </div>
             </form>
            </div>
            <div class="btn">
            <a href="./home.php" class="button" >Back</a>
                <button class="button" form="post-form">Submit</button>
            </div>
        </div>
    </div>
</body>
</html>