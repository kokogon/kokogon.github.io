
<?php
echo "<body style='background-color:#0b2b29;'>";
if(isset($_POST['back'])) {
	unset($_POST['back']);
	header("Location:index.php");
}
	
if(isset($_POST['submit'])) {
	unset($_POST['register']);
	#connection
	$conn = mysqli_connect("localhost","root",""); 

	if(!$conn) {
		die("Connection Error". mysqli_connect_error());
	}
	else {

		mysqli_select_db($conn, "1335848");

		$uname = mysqli_real_escape_string($conn,$_POST['uname']);
		$fname = mysqli_real_escape_string($conn,$_POST['fname']);
		$lname = mysqli_real_escape_string($conn,$_POST['lname']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$pass = mysqli_real_escape_string($conn,$_POST['pass']);
		$r_pass = mysqli_real_escape_string($conn,$_POST['r_pass']);

		$uname = strip_tags($uname);
		$fname = strip_tags($fname);
		$lname = strip_tags($lname);
		$email = strip_tags($email);
		$pass = strip_tags($pass);
		$r_pass = strip_tags($r_pass);


		$email  = strtolower($email);
		$uname = strtolower($uname);

		$error_ret =" ";
		$snek = true;

		#email validation
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error_ret = "Invalid E-mail Format";
				$snek = false;
			}
		#username dupes
			$sql = "SELECT * FROM memberlist WHERE username='$uname'";
			$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0) {
					$error_ret = "Username already taken";
					$snek = false;
				}
		#email dupes
			$sql = "SELECT * FROM memberlist WHERE email='$email'";
			$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) >0) {
					$error_ret = "Email already registered";
					$snek = false;
				}
		#password confirmed md5(md5(pass))
			if(!($pass === $r_pass)) {
				$snek = false;
				$error_ret ="Passwords did not match";
			} else {
				$pass = md5(md5($pass));
			} 
		
		if($snek) {

			$filename = "images/profile_".$uname.".png";
			copy("images/default_profile.png", $filename);

			$sql = "INSERT INTO memberlist (username, email, fname, lname , password, profile_pic) VALUES ('$uname','$email','$fname','$lname','$pass', '$filename')";
			mysqli_query($conn, $sql);
			mysqli_close($conn);

			header("Location:index.php");
		} else {
			echo "&nbsp&nbsp
						<span style='color:#d3ffef; font-family: Fashion'>".$error_ret."</span>";
			include("register.html");


		}
		

	}
}
?>
