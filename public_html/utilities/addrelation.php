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
    $user2 = $_POST['username'];
    $category = $_POST['type'];
    $username = $_SESSION["username"];
    $query = "INSERT INTO relation VALUES ('$username','$user2',$category);";
    $qResult = getResult($query);
    if($qResult == True){
        header("Location: /search.html?add_friend=yes");
    }
    else{
        header("Location: /search.html?add_friend=no");
    }
    
?>