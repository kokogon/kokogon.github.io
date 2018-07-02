<?php 
	session_start();
	if (isset($_SESSION['userID'])){

		if(isset($_POST['edit'])) {

			$user_id = $_SESSION['userID'];
			$r_pass = $_POST['r_pass'];
			$v_pass = $_POST['v_pass'];
			$newData['username'] = $_POST['edit_username'];
			$newData['fname'] = $_POST['fname'];
			$newData['lname'] = $_POST['lname'];
			$newData['email'] = $_POST['edit_email'];
			$newData['privacy'] = $_POST['privacy'];
			$newData['password'] = $_POST['pass'];

			$v_pass = md5(md5($v_pass));

			$conn = mysqli_connect("localhost","root","");
			if(!$conn) {
				die("Connection Error". mysqli_connect_error());
			}
			else {

				mysqli_select_db($conn, "1335848");

				$sql = "SELECT * FROM memberlist WHERE user_id='$user_id'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);

				if($row['password'] == $v_pass) {
					if($r_pass === $newData['password']) {

						foreach ($newData as $key => $value) {
							if(!($newData[$key] == $row[$key])) {
								if(strlen($value) > 0) {
									if($key =="password") {
										$value= md5(md5($value));
									}
									$sql = "UPDATE memberlist SET $key = '$value' WHERE user_id='$user_id'";
									mysqli_query($conn, $sql);
								}	
							} 
						}

						$newData['username'] = 0;
						$newData['fname'] = 0;
						$newData['lname'] = 0;
						$newData['email'] = 0;
						$newData['privacy'] = 0;
						$newData['password'] = 0;
						unset($_POST['edit']);
						header("Location:index.php");
					} else {
						echo "New Passwords did not match.";
						include("sidebar.php");
					} 
				} else   {
					echo "Current Password is inccorect.";
					include("sidebar.php"); 
				}

			}
		}

		if(isset($_POST['Upload'])) {
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
    			echo $_FILES['profileImage']['tmp_name'],"images/profile_".$row['username'].".png";
    			move_uploaded_file($_FILES['profileImage']['tmp_name'],"images/profile_".$row['username'].".png");
    			header("Location:landing.php");
    		}
		}
	} else header("Location:landing.php");
	
?>