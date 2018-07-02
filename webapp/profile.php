<?php
session_start();
  if(!isset($_SESSION['userID'])) {
    header("Location:index.php");
  }  

  $uid = $_GET['uid']; 
  $conn = mysqli_connect("localhost", "root","");
  if(!$conn) {
    die("Connection Error". mysqli_connect_error());
    }
  else {
    mysqli_select_db($conn, "1335848");
    $sql = "SELECT * FROM memberlist WHERE user_id='$uid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $profile_pic = $row['profile_pic'];
    $email = $row['email'];
    $privacy = $row['privacy'];   

    if($privacy>0) {
      $privacy = true;
    } else $privacy =false;


    }


function createPost_($profile_pic, $username,$photo, $caption) {

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
          echo  $username;
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
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <style>

    html { height: 100%; overflow: auto; }
    body {height: 100%; overflow: auto;}

    .post_container{
      width: 33%;
      padding:15px;
      margin: auto;
      display:inline-block;
    }

    .post_head {
      background: #0b2b29;
      padding: 15px;
      border-top-right-radius:      25px;
      border-top-left-radius:      25px;
      width: 100%;
    }

    .post_pic {
      background: #fffbed;
      width: 100%;
    }

    .profile_pic{
      width: auto;
      height: 50px;
      clip-path: circle(25px at center);
      margin-left: 25px;
    }

    .post{
      width: 100%;
      margin: auto;
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
      width:100%;
      background: #0b2b29b5;
      padding: 5px;
    }
    .caption {
      font-size: 16px;
      font-family: Kiona;
      font-weight: bolder;
      color: #fff;
    }


    .prof_cont {
      width: 80%;
      margin:auto;
      padding: 25px;
    }

    .prof_head{
      background-color: #750044;
      padding: 25px;
      border-top-right-radius: 25px;
      border-top-left-radius: 25px;
    }

    .name{
      color: #750044;
    }

    .prof_foot{
        background-color: #0b2b29b5;
        padding 10px;
    }

    .profile_header_text{
      font-family: Kiona;
      font-size: 32px;
      color: #fff;
    }
    
  .prof_body{
     background-color: #f7fdff !important;
  }
  
  .profile-picture {

    max-width:300px;
    max-height:auto;
    clip-path: circle(70px at center);
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding: 10px;
      
  }
  .name{
    font-size: 5vw;
    font-family: Fashion;
    font-weight: bolder;

  }

  </style>
</head>
<body style="
    background-image: url('images/bg-02.jpg'); 

    background-size: 100% 100%;">
    
    <div class=prof_cont>
      <div class=prof_head>
        <span class =profile_header_text>
          <?php
            echo "<center>";
            echo $username."'s Profile</center>"; 
          ?> 
        </span>
      </div>
      

      <div class=prof_body>
        <?php
          echo "<img src=".$profile_pic." class='profile-picture'>";
         ?>

        <div>
          <span class=name>
            <center>
              <?php 
                echo $fname." ".$lname;
              ?>    
            </center>
        </span>

        <span style="
          font-family: Kiona;
          font-size: 4vw;
          font-weight: bolder;
        ">
            <center style="color: #750044;">
              Posts
            </center>
        </span>
        <hr style="

          border-top: 2px dashed #750044;
          border-bottom: 5px dashed #75004400;

        ">
        <?php 

          $sql = "SELECT * FROM posts WHERE user_id='$uid'"; 
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
               
                createPost_($v_result['profile_pic'], $v_result['username'],$x, $value['caption']);
          
              }
            }
          }

        ?>
        </div>
      </div>
      <div class= prof_foot>
      </div>

    </div>
    <div class="container-login100-form-btn m-t-32">
      <a href="landing.php" style="padding: 10px;">
   
            <button class="login100-form-btn" name="login">
              Back
            </button>
      </a>
    </div>
     
</body>
</html> 
