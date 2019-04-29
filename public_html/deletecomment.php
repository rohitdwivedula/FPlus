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
	require_once("./utilities/db_connection.php");
    $username = $_SESSION["username"];
    $comment_id = $_GET['id'];
    echo $comment_id;
    $query = "DELETE FROM comments WHERE username = '{$username}' AND comment_id = {$comment_id};";
    echo $query;
    $qResult = getResult($query);
    if($qResult == True){
        header("Location: /post.php?id={$_GET['post']}");
    }
    else{
        header("Location: /post.php?id={$_GET['post']}");
    }  
?>