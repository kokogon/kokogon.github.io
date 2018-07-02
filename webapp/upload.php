<?php 

	 if(!isset($_SESSION['userID'])) {
    	session_start();
  	} 
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
    $conn = mysqli_connect("localhost", "root","");
		$uid = $_SESSION['userID'];
		$caption = mysqli_real_escape_string($conn,$_POST['caption']);
    $caption = strip_tags($caption); 
  	if(!$conn) {
 			die("Connection Error". mysqli_connect_error());
   		}
   		else {
			$target_dir = "images/posts/";
			$target_file = $target_dir . basename($_FILES["fileToPost"]["name"]);
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			mysqli_select_db($conn, "1335848");
    		
    		$check = getimagesize($_FILES["fileToPost"]["tmp_name"]);
    			if($check !== false) {
              $sql = "INSERT INTO posts (caption, photo, user_id) VALUES ('$caption','$target_file', '$uid')";
              $result = mysqli_query($conn, $sql);
              $lastID = mysqli_insert_id($conn);
              $fileName = substr($target_file, 0, -4);
              $fileName = $fileName."_".$lastID.".".$imageFileType;

       				move_uploaded_file($_FILES['fileToPost']['tmp_name'],$target_file);
       				rename($target_file, $fileName);

       				$sql = "UPDATE posts SET photo = '$fileName' WHERE post_id='$lastID'";
    				  $result = mysqli_query($conn, $sql);
       				header("Location:index.php");
    			} else {
        			echo "File is not an image.";
              unset($_POST['submit']);
        			header("Location:filenotimg.php");
        		}  		
   		}
	}
?>

<html>
<style type="text/css">
	
	.file {
 	 position: relative;
	}
	.file label {
  		text-align: center;
  		background: #004843;
  		padding: 5px 20px;
  		color: #fff;
  		font-family: Kiona;
  		font-weight: bold;
  		font-size: .9em;
  		transition: all 1s;
  		border-radius: 5px;
  		display: block;
  		min-width: 100px;

		}	
	.file input {
  		position: absolute;
  		display: inline-block;
  		left: 0;
  		top: 0;
  		opacity: 0;
  		cursor: pointer;
		}
	.file input:hover + label,
	.file input:focus + label {
  		background: #79174c;
  		color: #1ed2cb;
	}

	textarea {
 		margin-top: 10px;
  		width: 300px;
  		height: 70px;
  		-moz-border-bottom-colors: none;
  		-moz-border-left-colors: none;
  		-moz-border-right-colors: none;
  		-moz-border-top-colors: none;
  		background: none repeat scroll 0 0 #32605e52;
  		border-color: -moz-use-text-color #FFFFFF #FFFFFF -moz-use-text-color;
  		border-image: none;
  		border-radius: 6px 6px 6px 6px;
  		border-style: none solid solid none;
  		border-width: medium 1px 1px medium;
  		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.12) inset;
  		color: #cb4688;
  		font-family: Kiona;
  		font-size: 12px;
  		line-height: 1.4em;
  		padding: 5px 8px;
  		transition: background-color 0.2s ease 0s;

	}

	textarea::placeholder {
		color: #fff;
    	text-align: center;

		
	}

	textarea:focus {
    	background: none repeat scroll 0 0 #FFFFFF;
    	outline-width: 0;
	}
</style>

<form method="post" action="upload.php" enctype="multipart/form-data">
  
  			<p class="file">
    				<input type="file" name="fileToPost" id="fileToPost" />
    				<label for="file">Select</label>
  			</p>
  			<textarea placeholder="Place caption here" rows="20" name="caption" id="comment_text" cols="40" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true"></textarea>
			<p class="file m-t-10">
    			<input type="submit" name="submit" id="submit" />
    			<label for="submit">post</label>
  			</p>				  			
  	
</form>

</html>
