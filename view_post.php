<?php 
session_start();
require_once('DBConnection.php');
require_once('header.php');
$db = new DBConnection;
$conn = $db->conn;
date_default_timezone_set("Asia/Bangkok");
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT p.*, u.username, u.avatar FROM `post_list` p inner join `users` u on p.user_id = u.id where p.id= '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
        $_SESSION['post_id'] = $_GET['id'];
    }else{
        header('Location: ./home.php');
    }
}else{
    header('Location: ./home.php');
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
    <?php if(isset($_SESSION['msg'])){?>
        <div class="card"><?=$_SESSION['msg']?></div>
    <?php 
unset($_SESSION['msg']);
}?>
</head>
<body>
        <?php 
        $posts = $conn->query("SELECT p.* FROM `post_list` p where p.id= '{$_GET['id']}' order by abs(unix_timestamp(p.date_created)) desc");
        $row = $posts->fetch_assoc();
        ?>
        <div class="card">
            <div class="view">
                <div class="view_top">
                <h1><?= strip_tags($row['title']) ?></h1>
                    <div>
                    <?php if(isset($_SESSION['id'])): ?>
            <?php if($_SESSION['id'] == $user_id): ?>
                <div class="button_top">
                <form action="./view_controllers.php" method = "POST">
            <button class="button_view" name="delete" value="delete">Delete</button>
            </form>
            <a class="button_view" href="./manage_post.php?id=<?= $_GET['id'] ?>">Edit</a>
                </div>
            <?php endif; ?>
            <?php endif; ?>
                    </div>
                </div><br>
            <div><?= strip_tags($row['content']) ?></div>
            <br>
            <small><i><?= time_elapsed_string($row['date_created']) ?></i></small><br>
            <small><i>
            <?php
            if($row['date_updated'] !== $row['date_created']){
                echo "Edited ";
            }
            ?>
            </i></small>
            </div>
        </div>
        <?php if(isset($_SESSION['id'])): ?>
        <h3 id="judulkomen">Comments : </h3>
        <?php 
        $comments = $conn->query("SELECT c.*, u.fullname, u.avatar FROM `comment_list` c inner join `users` u on c.user_id = u.id where c.post_id ='{$id}' order by abs(unix_timestamp(c.date_created)) asc ");
        while($row = $comments->fetch_assoc()):
        ?>
        <div class="card-komen">
                    <div class = "view_top">
                        <div class="prof-komen">
                        <?php if(isset($row['avatar'])): ?>
                        <img src="<?= validate_image($row['avatar']) ?>" alt="UserPicture" id="comment_photo">
                    <?php else: ?>
                    <img src="./asset/user.png" alt="UserPicture" id="UP">
                    <?php endif; ?>
                        <p id="namakomen"><?=strip_tags($row['fullname'])?></a>
                        </div>
                        <?php if($row['user_id'] == $_SESSION['id']): ?>
                            <form action="./view_controllers.php" method="POST">
                            <button class="button_view" name="deletecomment" value="<?= $row['id'] ?>">Delete</button>
                            </form>
                    <?php endif; ?>
                    </div><br>
                            <div><?= $row['comment'] ?></div><br>
                            <div><small class="text-muted"><i><?= time_elapsed_string($row['date_created']) ?></i></small></div>
                            </div>
            <?php endwhile; ?>
            <div class= "card-komen">
            <form action="./view_controllers.php" method="POST">
                        <div class="form-group">
                            <textarea type="text"placeholder="Write down your comments" name="comment" id="comment" required ></textarea>
                        </div>
                        <div class="btn">
                            <a href="./home.php" class="button" >Back</a>
                            <button class="button" name="addcomment" value = "addcomment">Submit</button>
                            </div>
             </form>
            </div>
        <?php else: ?>
            <div class='card'><a id ="href" href="./login.php">Login</a> or <a id ="href" href="./register.php">Register</a> to leave a comment</div>
        <?php endif; ?>
</body>
</html>

<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>