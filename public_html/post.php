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
if($_SERVER['REQUEST_METHOD'] === "POST"){
    require_once("./utilities/add_comment.php");
    add_comment($_POST['id'], $_POST['comment']);
    exit();
}
?>

<?php if(!isset($_GET['id'])): ?>
<?php
	header("Location: feed_global.html");
?>

<?php else: ?>
<html>
	<head>
	    <title>Post Detail</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <link rel="icon" href="icon.png" type="image/x-icon">
	    <style type="text/css">
		    table {
		      font-family: arial, sans-serif;
		      border-collapse: collapse;
		      width: 100%;
		    }
		    td, th {
		      border: 1px solid #dddddd;
		      text-align: left;
		      padding: 8px;
		    }
		    tr:nth-child(even) {
		      background-color: #dddddd;
	    }
		</style>
	</head>
	<body>
	      <?php include 'navbar.php'; ?>
	      <div class="container">
	        <p></p>
	        <h2 align="center">Post Detail</h2>
	        <?php
	            require_once("./utilities/db_connection.php");
	            $username = $_SESSION["username"];
	            $query = "SELECT * FROM posts WHERE post_id =" . $_GET['id'] .';';
	            $result = getResult($query);
	            if($result && mysqli_num_rows($result)!=0){
	              while($row = mysqli_fetch_array($result)){
	                $body = $row['body'];
	                $date = $row['posted_on'];
	                $poster = $row['username'];
	                $visible_to = $row['visibility'];
	                if($visible_to == 1){
	                	$visible_to = "friends";
	                }
	                else if($visible_to == 2){
	                	$visible_to = "family";
	                }
	                else{
	                	$visible_to = "acquaintances";
	                }
	                if($poster == $_SESSION['username']){
	                	echo"<div class='card text-center border-dark mb-3'>
		                    <div align='left' class='card-header'>
		                      Posted by <b>$poster</b> on $date
		                    </div>
		                    <div class='card-body'>
		                      <p align='left' class='card-text'>$body</p>
		                      <center>
		                      	<a href='utilities/removepost.php?id={$_GET['id']}' class='btn btn-dark'>Remove</a>
		                      </center>
		                      <small>Visible only to your $visible_to  
		                    </div>
		                  </div>
		                  <p></p>";
	                }
	                else{
	                	echo"<div class='card text-center border-dark mb-3'>
		                    <div align='left' class='card-header'>
		                      Posted by <b>$poster</b> on $date
		                    </div>
		                    <div class='card-body'>
		                      <p align='left' class='card-text'>$body</p>
		                    </div>
		                  </div>
		                  <p></p>";
	                }
	                
	              }
	            }
	            else
	            {
	              echo "
	              <p align=\"center\">Post appears to be missing.</p>";
	            }

	        ?>
	        <form action = "/post.php" method = "post">
			    <input class="form-control" type="text" placeholder="Type comment and press enter to publish" name="comment" aria-label="Search">
			    <?php 
			    echo "<input type='hidden' name='id' value='{$_GET['id']}'>";
				?>
			</form>
	        <center><h2>Comments</h2></center>
	        <?php
            require_once("./utilities/db_connection.php");
            $id = $_GET["id"];
            $query = "SELECT * FROM comments WHERE post_id = {$id} ORDER BY commented_on DESC;";
            $result = getResult($query);
            if($result && mysqli_num_rows($result) != 0){
                echo "<table>
                    <tr>
                    	<th>
                    		User
                    	</th>
                        <th>
                            Comment
                        </th>
                    </tr>";
                while($row = mysqli_fetch_array($result)){
                    $text = $row["comment_text"];
                    $commentor = $row["username"];
                    $timestamp = $row["commented_on"];
                    $id = $row["comment_id"];
                    if($_SESSION['username'] == $commentor){
                    	echo"<tr>
                    		<td><b>$commentor</b></td>
	                        <td>$text <small>Posted on $timestamp. <a href='deletecomment.php?id={$id}&post={$_GET['id']}'> (Delete) </a></small></td>
	                    </tr>";
                    }
                    else{
                    	echo"<tr>
                    		<td><b>$commentor</b></td>
	                        <td>$text <small>Posted on $timestamp</small></td>
	                    </tr>";
                    }
                    
                }
                echo "</table>";
            }
            else{
                echo "<p style='text-align: center;'>No records could be found/fetched.</p>"; 
            }
        ?>
	      </div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
<?php endif ?>