<?php
echo "<body style='background-color:0b2b29'>";
session_start();
if(isset($_POST['register'])) {
	unset($_POST['register']);
	header("Location:register.html");
} 
if(isset($_POST['login'])) {

	$conn = mysqli_connect("localhost", "root",""); 
		if(!$conn) {
			die("Connection Error".mysqli_connect_error());
		}
		else {
			mysqli_select_db($conn, "1335848");
			$user =mysqli_real_escape_string($conn,$_POST['username']);
			$user = strtolower($user);
			$user = strip_tags($user);


			$sql = "SELECT * FROM memberlist WHERE username ='$user'";
			$result = mysqli_query($conn, $sql);
			if(mysqli_num_rows($result) == 1) {
				$pwd = mysqli_real_escape_string($conn,$_POST['pass']);
				$pwd = strip_tags($pwd);
				$pwd = md5(md5($pwd));

				$row = mysqli_fetch_assoc($result);

				if($pwd === $row['password']) {
					$_SESSION['userID'] = $row['user_id'];
					header("Location:landing.php");
				} else {
					echo "&nbsp&nbsp"."<span style='color:#d3ffef; font-family: Fashion'>Wrong Password</span>";
					include("index.php");
				}

			} else {
				echo "&nbsp&nbsp"."<span style='color:#d3ffef; font-family: Fashion'>User does not exist</span>";
				include("index.php");
			}

		}
}
	
?>
