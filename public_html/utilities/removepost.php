<?php
session_start();
$set = isset($_SESSION["firstname"]) && isset($_SESSION["username"]);
if(!$set){
    session_destroy();
    unset($_SESSION["firstname"]);
    unset($_SESSION["username"]);
    header("Location: index.html?error=timed_out");
    exit();
}
?>
<?php
    require_once("db_connection2.php");
    $id = $_GET['id'];
    $username = $_SESSION["username"];
    $query = "DELETE FROM posts WHERE username = '{$username}' AND post_id = {$id};";
    echo $query;
    $qResult = getResult($query);
    if($qResult == True){
        header("Location: /feed_global.html");
    }
    else{
        header("Location: /post.php?id={$id}");
    }  
?>