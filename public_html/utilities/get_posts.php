<?php
    function get_posts($username,$category)
    {
        require_once("db_connection.php");
        //$query1 = "SELECT user2 FROM relation WHERE user1='$username' AND relation_type='$category';";
        //$query2 = "SELECT relation_type FROM relation WHERE user1=($query1) AND user2='$username';";
        //$query3 = "SELECT * FROM posts WHERE username=($query1) AND visibilty=($query2);";
        $query = "SELECT * FROM posts WHERE username=(SELECT user2 FROM relation WHERE user1='$username' AND relation_type='$category') AND visibilty=(SELECT relation_type FROM relation WHERE user1=(SELECT user2 FROM relation WHERE user1='$username' AND relation_type='$category') AND user2='$username');";
        if($result = getResult($query))
        {
            if(mysqli_num_rows($result)>0)
            {
                while($row = mysql_fetch_array($result))
                {
                    echo $row['body']." ";
                }
            }
            else
            {
                printf("No posts to display.");
            }
        }
    
    }
?>