<?php 
require_once('sess_auth.php');
require_once('./connection.php');
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
        die;
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
        $_SESSION['msg'] = "New Post successfully saved";
        $id = $conn->insert_id;
        header('Location: ./manage_post.php?id='.$id);
        die;
    }
    else
    $_SESSION['msg'] = "Post successfully updated";
    header('Location: ./manage_post.php?id='.$id);
        die;
    
}else{
    $_SESSION['msg'] = "Failed to add post";
    header('Location: ./home.php');
    die;
}
}
?>