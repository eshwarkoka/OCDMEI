<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbit');
	//session_name('placement');
	session_start();
	if(!isset($_SESSION['placement'])) {
		echo "<script language='javascript'>window.location='index.php';</script>";
	}

   
	if(! $conn )
	{
		echo "Not connected to database." . mysqli_error();
	}
	echo "
		<html>
				<head>
					<title>Placements CBIT</title>
					<link rel='stylesheet' href='style.css'>
				</head>
				<body>
					<form action='placement.php' method='POST'>
						<input type='submit' style='float: right' value='Logout' name='logout'>
					</form>
					<center>
						<form action='placement.php' method='POST'>
							<input type='submit' name='submitcompanydetails' value='Enter Company Details'  class='sub_btn'>
						</form>
	";
	if(isset($_POST["logout"]))
	{
		//session_name('placement');
		unset($_SESSION['placement']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_POST["submitcompanydetails"]))
	{
		//session_start();
		//if(isset($_SESSION['logout'])) : header("Location: index.php");  endif;
		//session_name('placement');
		session_start();
		if(!isset($_SESSION['placement'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}	
		echo"
			<form action='placement.php' method='POST'>
				<table>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Company Name</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' placeholder='Enter Company Name' name='cname' required class='log_text2'>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Company Description</th>
						<td style='padding: 10px;font-size: 20px;'><textarea rows= '4' cols='16' placeholder='Enter Company Description' name='cdescription' required  style='font-size:20px; width:300px; height:75px; padding-left: 10px;'></textarea>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'> Salary</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' placeholder='Enter Salary' name='csalary' required class='log_text2'>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Cut-off</th>
						<td style='padding: 10px;font-size: 20px;'>	<input type='floatval' placeholder='Enter cutoff' name='ccutoff' required class='log_text2'>
						</td>
					</tr>
				</table>
				<input type='submit' name='submitcdetails' class='sub_btn'>
			</form>
			<hr>
		";
	}
	
	if(isset($_POST["submitcdetails"]))
	{
		//if(isset($_SESSION['logout'])) : header("Location: index.php"); endif;
		//session_name('placement');
		session_start();
		if(!isset($_SESSION['placement'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		$cname = $_POST['cname'];
		$cdescription = $_POST['cdescription'];
		$csalary = $_POST['csalary'];
		$ccutoff = $_POST['ccutoff'];
		$sql = "INSERT INTO placement(CompanyName, Description, Salary, Cutoff)
			VALUES ('$cname', '$cdescription', '$csalary', '$ccutoff')";
		if($conn->query($sql) === TRUE) 
		{
			echo "New record inserted successfully";
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	echo "
		<form action='placement.php' method='POST'>
			<input type='submit' name='submitstudentdetails' value='Enter Student Placement Details'  class='sub_btn'>
		</form>
	";
	if(isset($_POST["submitstudentdetails"]))
	{
		//if(isset($_SESSION['logout'])) : header("Location: index.php"); endif;
		//session_name('placement');
		session_start();
		if(!isset($_SESSION['placement'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		echo"
			<form action='placement.php' method='POST'>
				<table>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Roll No</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' placeholder='Enter Roll number' name='srollno' required class='log_text2'>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Company Name</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' placeholder='Enter Company Name' name='scname' required class='log_text2'>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Start Date</th>
						<td style='padding: 10px;font-size: 20px;'><input type='date' placeholder='Enter start date' name='ssdate' required class='log_text2'>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>End Date</th>
						<td style='padding: 10px;font-size: 20px;'><input type='date' placeholder='Enter end date' name='sedate' required class='log_text2'>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Result</th>
						<td style='padding: 10px;font-size: 20px;'>
							<select name='sresult' required class='log_text2'>
								<option value='Placed'>Placed</option>
								<option value='Not Placed'>Not Placed</option>
								<option value='Not Attempted'>Not Attempted</option>
								<option value='Not Interested'>Not Interested</option>
								<option value='Not Eligible'>Not Eligible</option>
							</select>
						</td>
					</tr>
				</table>
				<input type='submit' name='submitsdetails'  class='sub_btn'>
			</form>
			<hr>
		";
	}
	if(isset($_POST["submitsdetails"]))
	{
		//if(isset($_SESSION['logout'])) : header("Location: index.php"); endif;
		//session_name('placement');
		session_start();
		if(!isset($_SESSION['placement'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		$srollno = $_POST['srollno'];
		$scname = $_POST['scname'];
		$ssdate = $_POST['ssdate'];
		$sedate = $_POST['sedate'];
		$sresult = $_POST['sresult'];
		$sql = "INSERT INTO std_placement_details(RollNo, CompanyName, Start_Date, End_Date, Result)
			VALUES ('$srollno', '$scname', '$ssdate', '$sedate', '$sresult')";
		if($conn->query($sql) === TRUE) 
		{
			echo "New record inserted successfully";
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	
	echo "
		<form action='placement.php' method='POST'>
			<input type='text' placeholder='Enter Roll number' name='rollno' required class='log_text'>
			<input type='submit' name='submit' value='Search'  class='sub_btn'>
		</form>
	";
	if(isset($_POST["submit"]))
	{
		//if(isset($_SESSION['logout'])) : header("Location: index.php"); endif;
		//session_name('placement');
		session_start();
		if(!isset($_SESSION['placement'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		$rno = $_POST['rollno'];
		echo "<br><h1>Placement Details:<h1>";
		$sql="select CompanyName, Result from std_placement_details	where RollNo='$rno'";
		$retval = mysqli_query($conn, $sql);
		echo "
			<table border='1'>
				<tr>
					<th style='padding: 5px;font-size: 20px;'>Company Name</th>
					<th style='padding: 5px;font-size: 20px;'>Result</th>
				</tr>";
				while($row = mysqli_fetch_array($retval))
				{
					echo "
						<tr>
							<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
							<td style='padding: 10px;font-size: 20px;'>{$row['Result']}</td>
						</tr>
					";
				}
		echo"</table>";
	}
	echo "	
		<!--a href='logout.php' class='sub_btn'>Logout</a-->
		</body>
		</html>
		";
?>