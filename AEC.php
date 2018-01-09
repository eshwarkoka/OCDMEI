<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbit');
	session_start();
	if(!isset($_SESSION['aec'])) {
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
   
	if(! $conn )
	{
		echo "Not connected to database." . mysqli_error();
	}
	echo "
		<html>
				<head>
					<title>AEC CBIT</title>
					<link rel='stylesheet' href='style.css'>
				</head>
				<body>
					<form action='aec.php' method='POST'>
						<input type='submit' style='float: right' value='Logout' name='logout'>
					</form>
					<center>
						<form action='aec.php' method='POST'>
							<input type='submit' name='submitadmissiondetails' value='Enter Admission Details'  class='sub_btn'>
						</form>
	";
	if(isset($_POST["logout"]))
	{
		//session_name('placement');
		unset($_SESSION['aec']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}

	if(isset($_POST["submitadmissiondetails"]))
	{
		session_start();
		if(!isset($_SESSION['aec'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		echo"
			<form action='aec.php' method='POST' enctype='multipart/form-data'>
				<table>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>RollNo </th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='rollno' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Admission No </th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='adminno'  class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>First Name </th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='Fname' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Last Name </th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='Lname' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Father Name </th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='fatherN' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Phone No </th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='phno' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Address</th>
						<td style='padding: 10px;font-size: 20px;'><textarea rows= '4' cols='16' name='address'  style='font-size:20px; width:300px; height:75px; padding-left: 10px;' required></textarea></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Graduation</th>
						<td style='padding: 10px;font-size: 20px;'>
							<select name='graduation' class='log_text2' required>
								<option value='BE'>BE</option>
								<option value='B.Tech'>B.Tech</option>
								<option value='ME'>ME</option>
								<option value='M.Tech'>M.Tech</option>
							</select>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Branch</th>
						<td style='padding: 10px;font-size: 20px;'>
							<select name='branch' class='log_text2' required>
								<option value='CSE'>CSE</option>
								<option value='IT'>IT</option>
								<option value='ECE'>ECE</option>
								<option value='EEE'>EEE</option>
							</select>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Father Phno</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='Fphno' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Email ID</th>
						<td style='padding: 10px;font-size: 20px;'><input type='email' name='email' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Date of Joining</th>
						<td style='padding: 10px;font-size: 20px;'><input type='date' name='doj' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Photo</th>
						<td style='padding: 10px;font-size: 20px;'><input type='file' name='img' class='log_text2' required></td>
					</tr>
				</table>
				<br>
				<br>
				<input type='submit' name='submitsdetails'  class='sub_btn'>
			</form>
			<hr>
		";
	}
	
	if(isset($_POST["submitsdetails"]))
	{
		session_start();
		if(!isset($_SESSION['aec'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		//$img=$_FILES["img"]["name"];
		$imgtmp=addslashes(file_get_contents($_FILES['img']['tmp_name']));
		$Rno=$_POST['rollno'];
		$Ano=$_POST['adminno'];
		$fname=$_POST['Fname'];
		$lname=$_POST['Lname'];
		$fatherN=$_POST['fatherN'];
		$phno=$_POST['phno'];
		$address=$_POST['address'];
		$graduation=$_POST['graduation'];
		$branch=$_POST['branch'];
		$doj=$_POST['doj'];
		$fphno=$_POST['Fphno'];
		$email=$_POST['email'];
		
		$sql = "INSERT INTO admission VALUES ('$Ano', '$Rno', '$fname', '$lname', '$fatherN', '$phno', '$address', '$graduation', '$branch', '$doj', '$fphno', '$email', '$imgtmp')";
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
		<form action='aec.php' method='POST'>
			<input type='submit' name='submitattendancedetails' value='Enter Attendance Details'  class='sub_btn'>
		</form>
	";


	if(isset($_POST["submitattendancedetails"]))
	{
		session_start();
		if(!isset($_SESSION['aec'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		echo"
			<form action='aec.php' method='POST'>
				<table>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Roll No</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='rollno' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Course ID</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='cid' class='log_text2' required></td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Branch</th>
						<td style='padding: 10px;font-size: 20px;'>
							<select name='branch2' required class='log_text2'>
								<option value='CSE'>CSE</option>
								<option value='IT'>IT</option>
								<option value='ECE'>ECE</option>
								<option value='EEE'>EEE</option>
							</select>
						</td>
					</tr>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Attendance</th>
						<td style='padding: 10px;font-size: 20px;'><input type='text' name='attendance' class='log_text2' required></td>
					</tr>
				</table>
				<br><br>
				<input type='submit' name='submitadetails'  class='sub_btn'>
			</form>
			<hr>
		";
	}
	if(isset($_POST["submitadetails"]))
	{
		session_start();
		if(!isset($_SESSION['aec'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
		$rno = $_POST['rollno'];
		$cid=$_POST['cid'];
		$branch=$_POST['branch2'];
		$Attendance=$_POST['attendance'];
		$sql = "INSERT INTO aec	VALUES('$rno', '$cid', '$branch', '$Attendance')";
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
		<form action='aec.php' method='POST'>
			<input type='text' placeholder='Enter Roll number' name='rollno' required class='log_text'>
			<input type='submit' name='submit' value='Search' class='sub_btn'>
		</form>
	";

	if(isset($_POST["submit"]))
	{
		if($_POST['rollno']!=null)
		{
			session_start();
		if(!isset($_SESSION['aec'])) {
			echo "<script language='javascript'>window.location='index.php';</script>";
		}
			$rno = $_POST['rollno'];
			$sql = "select * from admission where rollno='$rno'";
			$retval = mysqli_query($conn, $sql);
			if(! $retval )
			{
				echo "<script>alert('Entered RollNo does not exist!')</script>";
				die('Could not get data: ' . mysqli_error());
			}
								
			while($row = mysqli_fetch_array($retval))
			{
				echo "<h1>Admission Details:</h1>
				<table border='1'>
					<tr>
						<th rowspan='4'><img src='data:image/jpeg;base64,".base64_encode( $row['Photo'] )."' width=150px height=200px />
						</th>
						<th style='padding: 5px;font-size: 20px;'>Name</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['FirstName']}"." "."{$row['LastName']}</td>
						<tr>
							<th style='padding: 5px;font-size: 20px;'>Roll number</th>
							<td style='padding: 10px;font-size: 20px;'>{$row['RollNo']}</td>
						</tr>
						<tr>
							<th style='padding: 5px;font-size: 20px;'>Admission No</th>
							<td style='padding: 10px;font-size: 20px;'>{$row['AdminNo']}</td>
						</tr>
						<tr>
							<th style='padding: 5px;font-size: 20px;'>Phone Number</th>
							<td style='padding: 10px;font-size: 20px;'>{$row['Phno']}</td>
						</tr>
										
					</tr>
					<tr>
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Father Name</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['FatherName']}</td>
					</tr>
					<tr>
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Father Phno</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['FatherPhno']}</td>
					</tr>
					<tr>
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Address</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['Address']}</td>
					</tr>
					<tr>	
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Graduation</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['Graduation']}</td>
					</tr>
					<tr>
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Branch</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['Branch']}</td>
					</tr>
					<tr>	
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Date of Joining</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['Date of Joining']}</td>
					</tr>
					<tr>
						<th colspan='2' style='padding: 5px;font-size: 20px;'>Email Id</th>
						<td style='padding: 10px;font-size: 20px;'>{$row['email']}</td>
					</tr>
				</table>";
			}
								
			echo "<br><br><h1>Attendance Details:<h1>";
			$sql="SELECT CourseId, Coe.Cname, Attendance from coe natural join aec where RollNo='$rno'";
			$retval = mysqli_query($conn, $sql);
			echo "
				<table border='1'>
					<tr>
						<th style='padding: 5px;font-size: 20px;'>Course Id</th>
						<th style='padding: 5px;font-size: 20px;'>Course Name</th>
						<th style='padding: 5px;font-size: 20px;'>Attendance</th>
					</tr>";
					while($row = mysqli_fetch_array($retval))
					{
						echo "
							<tr>
								<td style='padding: 10px;font-size: 20px;'>{$row['CourseId']}</td>
								<td style='padding: 10px;font-size: 20px;'>{$row['Cname']}</td>
								<td style='padding: 10px;font-size: 20px;'>{$row['Attendance']}</td>
							</tr>
						";
					}
			echo"</table>";
		}
	}
	echo "	
		<!--a href='logout.php' class='sub_btn'>Logout</a-->
		</body>
		</html>
		";
?>