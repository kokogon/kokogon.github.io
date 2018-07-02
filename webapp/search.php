<?php
  session_start();
  if(!isset($_SESSION['userID'])) {
    echo "please login";
    include ("Location:index.php");
  }
  else {
    if(isset($_POST['submit'])) {
    $conn = mysqli_connect("localhost", "root","");
    $username= mysqli_real_escape_string($conn,$_POST['searchbox']);
    $username = strip_tags($username);

  
      if(!$conn) {
        die("Connection Error". mysqli_connect_error());
      }

    else {
        mysqli_select_db($conn, "1335848");
        $sql = "SELECT privacy,profile_pic,username,user_id FROM memberlist WHERE username LIKE'%$username%'";
        $result = mysqli_query($conn, $sql);
        $return = array();
        $i =0;
        
        while ($row = mysqli_fetch_assoc($result)) {
          $return[$i] = $row;
          $i++;
        }

        echo "<center><table align=center><tr><th style = 'border-top-left-radius: 25px; width: 150px;'>Profile Picture</th><th style='border-top-right-radius: 25px;'>Username</th></tr>";


          foreach ($return as $value) {
            $uid = $value['user_id'];
            if($value['privacy']!=1) {
              echo "<tr>";
              echo "<td><img src=".$value['profile_pic']." class ='profile-picture'></td>";
              echo "<td><a href=profile.php?uid=$uid class='username'>".$value['username']."</a></td>"; 
              echo "</tr>";  
            }
            
          }
        echo "</table></center>";

          
      }

  }  
    
  }
  
?>

<html>
 <style>
    html { height: 100%; overflow: auto; }
    body {height: 100%; overflow: auto;}

    table {
      border-radius: 25px;
      width: 50%;
      align-items: center;
      margin-top: 15px;
    }

    tr{
    }

    td{
      padding-bottom: 15px !important;
      padding-top: 15px !important;
      background-color: #f7fdff;
    }
    th{
      background-color: #750044;
      padding: 35px !important;
      color: #fff;
      font-family: Fashion;
    }
    .profile_pic_row{
      width: 150px;
    }
    .username{
      font-family: Snowball;
      font-size: 10vh;
      color: #002d20;
      margin-left: 50px;
      transition: .5s;
    }

    .username:hover{
      color: #750044;
    }

    .profile-picture {

    max-width:150px;
    max-height:auto;
    clip-path: circle(70px at center);
    display: block;
    margin-left: auto;
    margin-right: auto;
      
  }

</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<head>
 <body style="
    background-image: url('images/bg-02.jpg'); 
    background-attachment: fixed;
    background-size: 100% 100%;">
    <a href="landing.php" style="padding: 10px;">
     <div class="container-login100-form-btn m-t-32">
            <button class="login100-form-btn" name="login">
              Back
            </button>
      </div>
    </a>
  </body>
</html> 
