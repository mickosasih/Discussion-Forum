<?php
session_start();
require_once('DBConnection.php');
require_once('header.php');
$db = new DBConnection;
$conn = $db->conn;
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
    <div class = "container">
        <main class = "grid">
        <?php 
        $posts = $conn->query("SELECT p.* FROM `post_list` p order by abs(unix_timestamp(p.date_created)) desc");
        while($row = $posts->fetch_assoc()):
        ?>
        <a href="./view_post.php?id=<?= $row['id'] ?>">
            <article>
                        <div>
                        <h1><?= strip_tags($row['title']) ?></h1><br>
                        <div id="text"><?= strip_tags($row['content']) ?></div>
                        </div>
                        <div>
                        <small><i><?= time_elapsed_string($row['date_created']) ?></i></small><br>
                        <small><i>
            <?php
            if($row['date_updated'] !== $row['date_created']){
                echo "Edited ";
            }
            ?>
            </i></small>
                        </div>

            </article>
            </a>
            <?php endwhile; ?>
    </div>
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