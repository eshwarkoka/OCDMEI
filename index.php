<?php

	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbit');
   
	session_start();
	if(isset($_SESSION['placement'])) {
		unset($_SESSION['placement']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_SESSION['principal'])) {
		unset($_SESSION['principal']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_SESSION['aec'])) {
		unset($_SESSION['aec']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	
	if(! $conn )
	{
		echo "Not connected to database." . mysqli_error();
	}
		echo "
			<html>
				<head>
					<title>CBIT MANAGEMENT SYSTEM</title>
					<link rel='stylesheet' href='style.css'>
				</head>
				<body>
					<center>
					<br><br><br><br><br><br>
						<h1  style='font-size: 30px;color: #05A8AA;'>
								Chaitanya Bharathi Institute of Technology
							</h1>
						<form method='POST' action='index.php' >
							<h3>USERNAME	
							<input type='text' name='username' required class='log_text' placeholder='Enter Username'><br><br>
							PASSWORD
							<input type='password' name='password' required class='log_text' placeholder='Enter Password'><br>
							<input type='submit' value='Login' name='submit' class='sub_btn'></h3>
						</form>
					</center>
				</body>
			</html>
		";
				
		if(isset($_POST["submit"]))
		{
			if($_POST['username']!=null&&$_POST['password']!=null)
			{				
				$uname = $_POST['username'];
				$pword = $_POST['password'];
				
				//$_SESSION["username"] = $_POST['username'];
				//$_SESSION["password"]= $_POST['password'];
				
				$sql="SELECT * from login where Username='$uname' and Password=Password('$pword');";
				$retval = mysqli_query($conn, $sql);
				if(mysqli_affected_rows($conn)==0)
				{
					echo "<script>alert('Invalid user credentials!! ')</script>";
					//die('Could not get data: ' . mysqli_error());
				}
				else
				{
					$role=0;
					while($row = mysqli_fetch_array($retval))
					{
						//echo "<script>alert('3')</script>";
						$role=$row['Role'];
						switch($role)
						{
							case "Principal":
								session_start();
								$_SESSION['principal'] = 'principal';
								echo "<script language='javascript'>window.location='principal.php';</script>";
								break;
							case "Placement":
								session_start();
								$_SESSION['placement'] = 'placement';
								echo "<script language='javascript'>window.location='placement.php';</script>";
								break;
							case "AEC":
								session_start();
								$_SESSION['aec'] = 'aec';
								echo "<script
								language='javascript'>window.location='aec.php';</script>";
								break;
							case "COE":
								echo "<script language='javascript'>window.location='coe.php';</script>";
								break;
							case "Library":
								echo "<script language='javascript'>window.location='library.php';</script>";
								break;
							case "CSE":
								echo "<script language='javascript'>window.location='cse.php';</script>";
								break;
							case "IT":
								echo "<script language='javascript'>window.location='it.php';</script>";
								break;
						}
					}
				}	
			}
		}
?>