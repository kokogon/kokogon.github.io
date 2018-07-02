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
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  ::-webkit-scrollbar { 
    display: none; 
  }
  @font-face {
        font-family: Fashion-bold;
        src: url('fonts/Fashion/Fashion Fetish Bold.ttf');
    }

  @font-face {
        font-family: Fashion;
        src: url('fonts/Fashion/Fashion Fetish Light.ttf');
    }

  @font-face {
        font-family: Snowball;
        src: url('fonts/Snowballs/Snowballs City.tff');
    }



/*------------------------------------------------------------------
[ profile Pic ]*/

  .profile-picture {

    max-width:150px;
    max-height:auto;
    clip-path: circle(70px at center);
    display: block;
    margin-left: auto;
    margin-right: auto;
      
  }

/*------------------------------------------------------------------
[ Text ]*/

  ._profileHeaderText {

    position: relative;
    font-family: Snowball; 
    font-size: 40px;
    font-size:5vw;
    line-height: 1;
    color: #088c83;
    text-transform: lowercase;
  }

  .editText_minis {
  font-family: Kiona; 
  text-transform: uppercase; 
  font-size: 18px; 
  margin-left: 80px;
  color: #750044;
  font-weight: bolder;
  }

  ._profileTagText {

    font-family: Fashion; 
    font-size: 32px;
    font-size: 0.8vw;
    color: #0de8d4;
  }

  ._profileTagText-Bold {

    font-family: Fashion; 
    font-size: 42px;
    font-size: 1vw;
    font-weight: bolder;
    color: #0de8d4;
  }

/*------------------------------------------------------------------
[ sidebar ]*/

  .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgba(11, 43, 41, 0);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;

  /*  box-shadow: 0px 0px 10px 1px #0b2b29;
*/  }

  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }

  .sidenav a:hover {
    color: #b5036a;
  }

  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
    color: #088c83;
  } 

/*------------------------------------------------------------------
[ buttons ]*/
  .smolbut {
  font-family: Fashion;
  font-size: 12px;
  color: #fff;
  line-height: 1.2;
  
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  min-width: 20px;
  height: 20px;
  border-radius: 21px;

  background: #750044;
  background: -webkit-linear-gradient(bottom,#750044, #04534e);
  background: -o-linear-gradient(bottom,#750044, #04534e);
  background: -moz-linear-gradient(bottom, #750044, #04534e);
  background: linear-gradient(bottom, #750044, #04534e);
  position: relative;
  z-index: 1;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

  .smolbut::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 21px;
  background-color: #750044;
  top: 0;
  left: 0;
  opacity: 0;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
  }

  .smolbut:hover {
    background-color: transparent;
  }

  .smolbut:hover:before {
    opacity: 1;
  }

  .vikoButon {
    font-family: Fashion;
    font-size: 12px;
    color: #fff;
    line-height: 1.2;
  
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    min-width: 120px;
    height: 25px;
    border-radius: 21px;

    background: #750044;
    background: -webkit-linear-gradient(bottom,#750044, #04534e);
    background: -o-linear-gradient(bottom,#750044, #04534e);
    background: -moz-linear-gradient(bottom, #750044, #04534e);
    background: linear-gradient(bottom, #750044, #04534e);
    position: relative;
    z-index: 1;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }

  .vikoButon::before {
  content: "";
  display: block;
  position: absolute;
  z-index: -1;
  width: 100%;
  height: 100%;
  border-radius: 21px;
  background-color: #00544f;
  top: 0;
  left: 0;
  opacity: 0;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
  }

  .vikoButon:hover {
  background-color: transparent;
  }

  .vikoButon:hover:before {
  opacity: 1;
  }

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
  }
  /*------------------------------------------------------------------
[ Modal ]*/
  .modal { 

   margin-top: 0px !important;
   padding-top: 450px !important;
   background-color: rgba(0,40,38,0.85) !important; 

  }

  .modal-header {
  background-color: #750044 !important;
  border-top-right-radius: 25px !important;
  border-top-left-radius: 25px !important;
  }

  .modal-content {
    border-top-right-radius: 30px !important;
    border-top-left-radius: 30px !important;
    background-color: #f7fdff !important;
  }

/*------------------------------------------------------------------
[ Checkbox ]*/
/* Customize the label (the container) */
  .container {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  }

/* Hide the browser's default checkbox */
  .container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  }

/* Create a custom checkbox */
  .checkmark {
  position: absolute;
  top: 0;
  left: 80px;
  height: 25px;
  width: 25px;
  background-color: #9b0057;
  border-radius: 8px;
  }

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #600036;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #750044;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 7px;
  height: 14px;
  border: solid #bc297f;
  border-width: 0 4px 4px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

}
</style>

<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body id=main style="
    background-image: url('images/bg-02.jpg'); 
    background-repeat: no-repeat !important;
    background-attachment: fixed !important;
    background-size: 100% 100%;">
<!-- SideNav -->
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="row">
    <div class = "col-sm-2"></div>
    <div class="col-sm-8 m-t-5">
    <?php
     echo "<img src=".$profile_pic." class='profile-picture'>"
    ?>
      <br>
          <p align="center" class="_profileHeaderText">
            <?php  
              echo $username;
            ?>
          </p>
          <p align="center" class="_profileTagText">
            <?php  
              echo ucfirst($fname) . " " . ucfirst($lname);
            ?>
          </p>
           <?php include("searchbar.html");?>
          <br>
          <p align="center" class="_profileTagText" style="font-weight: bolder !important; font-size: 16px;">
              UPLOAD PICTURE
          </p>
          
        <div class="container-login100-form-btn m-t-8">
        <?php include("upload.php");?>

        </div>
    </div>
    <div class = "col-sm-2"></div>
  </div>
        
  <div class="row">
    <div class = "col-sm-1"></div>
    <div class="col-sm-10 m-t-30">
      <div class="container-login100-form-btn m-t-5">
         <button type="button" class="vikoButon" id="myBtn2"> Edit Profile</button>
      </div>
      <div class="container-login100-form-btn m-t-10">
        <form method="post" action="sidebar_utilities.php">
          <button class="vikoButon" name='Logout'">
            Logout
          </button>
        </form>
      </div>  
    </div>
    <div class = "col-sm-1"></div>
  </div>

</div>


<!--main body-->
<div class="body_container" style="
    background-image: url('images/bg-02.jpg'); 
    background-repeat: no-repeat;
    background-attachment: fixed !important;
    background-size: 100%;">
  <!--button-->
      <span style="font-size:30px;cursor:pointer" onclick="openNav()"><img src="images\profile_button.png" style="width: 100px; height: auto; margin-left: -50px; position: fixed; margin-top: 80px;"></span>
      <div class="body_header">
        <span class="login100-form-title_logo" style="color: rgba(255,255,255,.75) !important; font-size: 25vw !important;">   *Abragram 
        </span>
      </div>
    
      


     
<!-- Modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="height: 100px !important; font-size: 50px !important;">
          <span style="font-family: Kiona; color: #bf227d;"><?php echo $username ?>'s Profile</span>
        </div>
        <div class="modal-body">
          <div class="container-login100-form-btn m-t-10">
            <?php
              echo "<img src=".$profile_pic." class='profile-picture' style='margin-bottom: 10px; height: 200px !important;'>"
            ?>
          </div>
           <form class="login100-form validate-form p-t-5" method="post" action="edit.php" enctype="multipart/form-data">
              <div class="wrap-input100">
                <span class="editText_minis">
                  Profile Picture
                </span>
                <input type="file" name="profileImage" id="profileImage" style="margin-left: 80px; padding-top: 20px;">
                <input type="submit" class = "vikoButon m-l-80 m-t-8" value="Upload Image" name="Upload">
              </div>
            </form>

            <form class="login100-form validate-form p-b-33 p-t-5" method="post" action="edit.php">
              <div class="wrap-input100">
                <span class="editText_minis">
                  Username:
                </span>
                <input class="input100" type="text" name="edit_username" value="<?php echo $username?>">
              </div>

              <div class="wrap-input100">
                <span class="editText_minis">
                 Password:
                </span>
                <input class="input100" type="password" name="pass" placeholder="Password">
              </div>

               <div class="wrap-input100">
                <span class="editText_minis">
                 Re-Type Password:
                </span>
                <input class="input100" type="password" name="r_pass" placeholder="Password">
              </div>

              <div class="wrap-input100">
                <span class="editText_minis">
                  First Name:
                </span>
                <input class="input100" type="text" name="fname" value='<?php echo $fname ?>'>
              </div>

              <div class="wrap-input100">

                <span class="editText_minis">
                  Last Name:
                </span>
                <input class="input100" type="text" name="lname" value='<?php echo $lname ?>'>
              </div>

              <div class="wrap-input100">
                <span class="editText_minis">
                  E-mail:
                </span>
                <input class="input100" type="email" name="edit_email" value='<?php echo $email ?>'>
              </div>

              <div class="wrap-input100">
                <?php
                    if($privacy) {
                      echo "
                      <span class='editText_minis' style = 'margin-left: 80px !important; font-size: 20px !important; color: #004b4c !important;'>
                      Your profile is not displayed on searches.
                      </span> 
                      "; 
                    } else {
                      echo "
                      <span class='editText_minis' style= 'margin-left: 80px !important; font-size: 20px !important;color: #004b4c !important;'>
                      Your profile is displayed in searches.
                      </span>
                      ";
                    }
                 ?>
              
                <label class="container">
                  <span class="editText_minis" style="margin-left: 95px !important;">
                    Private
                  </span>
                  <input type="radio" <?php if($privacy) echo "checked" ?> name="privacy" value="1">
                  <span class="checkmark"></span>
                </label>
                <label class="container">
                  <span class="editText_minis" style="margin-left: 95px !important;">
                    Public
                  </span>
                  <input type="radio" name="privacy" <?php if(!$privacy) echo "checked" ?> value="0">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="wrap-input100 validate-input" data-validate="Enter current password">
                <input class="input100" type="password" name="v_pass" 
                  placeholder="Enter current password to validate">
                <span class="focus-input100" data-placeholder="&#xe80f;"></span>
              </div>

              <div class="container-login100-form-btn m-t-32">
                <button class="login100-form-btn" name ='edit'>
                  Edit
                </button>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="smolbut" data-dismiss="modal">Back</button>
        </div>
      </div>
      
    </div>
</div>

  <center>
    <?php
      include("gallery.php");
    ?>
  </center>
       

<script>
  $(document).ready(function(){
    $("#myBtn2").click(function(){
        $("#myModal2").modal({backdrop: "static"});
    });
  });

  function openNav() {
    document.getElementById("mySidenav").style.width = "350";
    document.getElementById("main").style.marginLeft = "350";
    document.getElementById("main").style.transition = "0.5s";
  }
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("main").style.transition = "0.5s";
  }
</script>
     
</body>
</html> 
