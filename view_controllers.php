<?php 
session_start();
require_once('DBConnection.php');
$db = new DBConnection;
$conn = $db->conn;
date_default_timezone_set("Asia/Bangkok");
if(isset($_SESSION['post_id'])){
    $qry = $conn->query("SELECT p.*, u.username, u.avatar FROM `post_list` p inner join `users` u on p.user_id = u.id where p.id= '{$_SESSION['post_id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        header('Location: ./home.php');
        die;
    }
}else{
    header('Location: ./home.php');
    die;
}
if($_SERVER['REQUEST_METHOD']==="POST"){
    if(array_key_exists('delete', $_POST) && $_SESSION['id'] == $user_id){
        extract($_POST);
		$del = $conn->query("DELETE FROM `post_list` where id = '{$_SESSION['post_id']}'");
		if($del){
            $_SESSION['msg'] = "Successfully deleted";
            header('Location: ./home.php');
            unset($_SESSION['post_id']);
            die;
		}else{
			$_SESSION['msg'] = "Failed to delete";
            header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
		}
    }
    if(array_key_exists('addcomment', $_POST) && isset($_SESSION['id'])){
        if(empty($_POST['comment'])){
            $_SESSION['msg'] = "Comment should not be empty!";
            header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
        }else if(strlen($_POST['comment']) < 4 || (strlen($_POST['comment'])>512)){
            $_SESSION['msg'] = "Comment length should be between 4 and 512 characters long";
            header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
        }
        $_POST['user_id'] = $_SESSION['id'];
        $_POST['post_id'] = $_SESSION['post_id'];
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))&& $k != 'addcomment'){
				if(!empty($data)) $data .=",";
				$v = $conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$sql = "INSERT INTO `comment_list` set {$data} ";
        $save = $conn->query($sql);
		if($save){
			$_SESSION['msg'] = "New Comment successfully added";
            header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
		}else{
			$_SESSION['msg'] = "Failed to add comment";
            header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
		}
    }
    if(array_key_exists('deletecomment', $_POST)){
        $comments = $conn->query("SELECT c.*FROM `comment_list` c where c.post_id ='{$id}' and c.id = '{$_POST['deletecomment']}'");
        $row = $comments->fetch_assoc();
        if($row['user_id'] == $_SESSION['id']){
            $del = $conn->query("DELETE FROM `comment_list` where id = '{$_POST['deletecomment']}'");
    if($del){
        $_SESSION['msg'] = "Comment successfully deleted";
        header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
    }else{
        $_SESSION['msg'] = "Failed to delete comment";
        header('Location: ./view_post.php?id='.$_SESSION['post_id']);
            die;
    }
}
        }
}
?>