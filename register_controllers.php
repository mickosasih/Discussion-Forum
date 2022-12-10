<?php 
require_once('sess_auth.php');
require_once('./connection.php');
    if($_SERVER['REQUEST_METHOD']==="POST" && !empty($_POST['fullname']) && !empty($_POST['username'])&& !empty($_POST['password'])){
        if(!empty($_FILES['avatar']['tmp_name'])){
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg"
            );
            $file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    
            if (! in_array($file_extension, $allowed_image_extension)) {
                    $_SESSION['msg'] =  "Upload valid images. Only PNG and JPEG are allowed.";
                    header("Location: ./register.php");
                    die;
            }   
            else if(($_FILES["avatar"]["size"] > 2000000)) {
                $_SESSION['msg'] = "Image size exceeds 2MB";
                header("Location: ./register.php");
                die;
            }
        }
		$_POST['password'] = md5($_POST['password']);
		extract($_POST);
		$data = "";
		$check = $conn->query("SELECT * FROM `users` where username = '{$username}' ")->num_rows;
		if($check > 0){
            $_SESSION['msg'] = "Username already exists";
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
                    $new_file_path = "./uploads/avatars/$uid.$file_extension";
                    move_uploaded_file($temp_file_path, $new_file_path);
                    $fname = "uploads/avatars/$uid.$file_extension";
                    $conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$uid}'");
                }
                $_SESSION['msg'] ="Your Account has been created successfully";
            }
            else{
                $_SESSION['msg'] = "Failed to create account</div>";
            }
        }
        header("Location: ./register.php");
        die;
    }else{
        header("Location: ./register.php");
        die;
    }
     ?>