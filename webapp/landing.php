<?php 
session_start();
if(isset($_SESSION['userID'])) {
	include("sidebar.php");
} else  {
	echo "<body style='background-color:0b2b29;'>";
	echo "<span style='color:#d3ffef; font-family: Fashion'>Please log in</span>";
	include("index.php");
}
?>
<html>
<body style="
    background-image: url('images/bg-02.jpg'); 
    background-repeat: no-repeat;
    background-attachment: fixed !important;
    background-size: 100%;">
</body>
</html>

