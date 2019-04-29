<?php
	function add_comment($post_id, $text){
		require_once("db_connection.php");
		$username = $_SESSION['username'];
		$query = "INSERT INTO comments VALUES(DEFAULT, $post_id, '$username', '$text', now(), NULL)";
		echo $query;
		if($result = getResult($query)){
			header("Location: post.php?id={$post_id}");
		}
		else{
			header("Location: post.php?id=$post_id&error=yes");
		}
	}
?>