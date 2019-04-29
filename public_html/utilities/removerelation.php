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
    $user2 = $_GET['user'];
    $username = $_SESSION["username"];
    $query = "DELETE FROM relation WHERE user1 = '{$username}' AND user2 = '{$user2}';";
    $qResult = getResult($query);
    if($qResult == True){
        header("Location: /activity.html");
    }
    else{
        header("Location: /activity.html");
    }
    
?>