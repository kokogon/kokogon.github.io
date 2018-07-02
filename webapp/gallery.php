<?php 

 if(!isset($_SESSION['userID'])) {
    header("Location:index.php");
  }  

  $uid = $_SESSION['userID']; 
  $conn = mysqli_connect("localhost", "root","");
  if(!$conn) {
    die("Connection Error". mysqli_connect_error());
    }
  else {
    mysqli_select_db($conn, "1335848");

    $sql = "SELECT * FROM posts"; 
    $result = mysqli_query($conn, $sql);
    $posts = array();
    $i =0;
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[$i] = $row;
        $i++;
    }

    foreach($posts as $value ) {
    	foreach($value as $key=>$x) {
    		if($key == "photo") {
    			$v_uid=$value['user_id'];
    			$sql ="SELECT * FROM memberlist WHERE user_id ='$v_uid'";
    			$result = mysqli_query($conn, $sql);
    			$v_result = mysqli_fetch_assoc($result);
    		
    			createPost($v_result['profile_pic'], $v_result['username'],$x, $value['caption'],$v_result['user_id']);
    			
    			
    		}
    	}
    }
    }
   


function createPost($profile_pic, $username,$photo, $caption,$uid) {

	?>
	<html>
	<div class="post_container">
  	<div class ="post">
    <div class = "post_head">
      <div class="row">
      	<?php
     	echo "<img src=".$profile_pic." class='profile_pic'>"
    	?>
        <span class="username">
            <?php
     			echo "<a href='profile.php?uid=$uid' class='username'>" . $username . "</a>";
    		?>
          </span><br>
      </div>
    </div>
    <div class = "post_pic">
      <center>
      <?php
      echo "<img src=".$photo." class='post'>";
      ?>  
        
      </center>
      
    </div>
    
    <div class = "post_foot">   
      <span class= caption><?php echo nl2br($caption) ?></span>  
    </div>
    
  </div>
</div>

	</html>
	<?php


}



?>
<html>
<head>
<style>
/*------------------------------------------------------------------
[ post ]*/

.post_container{
  width: 80%;
  padding:15px;

}
.post_head {
  background: #0b2b29b5;
  padding: 15px;
  border-top-right-radius:      25px;
  border-top-left-radius:      25px;
  width: 80%;
}

.post_pic {
  background: #fffbed;
  width: 80%;

}

.profile_pic{
  width: auto;
  height: 50px;
  clip-path: circle(25px at center);
  margin-left: 25px;
  
  
}
.post{
  width: 100%;
}
.div-center{
  align-content: center;
}

.username {
  font-family: Snowball;
  font-size: 32px;
  margin-top: 5px;
  margin-left: 5px;
  color: #fff;
}

.username:hover {
  color: #ffa8c3;
  transition: color 2s;
}

.post_foot{
  width:80%;
  background: #0b2b29b5;
  padding: 5px;
}
.caption {
  font-size: 16px;
  font-family: Kiona;
  font-weight: bolder;
  color: #fff;
}

</style>
</head>
<body>

</body>
</html>


