<?php
	$dbhost = 'localhost';
	$dbuser = 'admin';
	$dbpass = 'cbit';
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'cbit');
	session_start();
	if(!isset($_SESSION['principal'])){
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
   
	if(! $conn )
	{
		echo "Not connected to database." . mysqli_error();
	}
	echo "
		<html>
				<head>
					<title>Principal CBIT</title>
					<link rel='stylesheet' href='style.css'>
				</head>
				<body>
					<form action='principal.php' method='POST'>
						<input type='submit' style='float: right' value='Logout' name='logout'>
					</form>
					<center>
						<form action='principal.php' method='POST'>
							<h3>Enter Roll number
							<input type='text' name='rollno' required class='log_text' placeholder='Enter Roll Number'>
							<input type='submit' name='submit' value='search' class='sub_btn'>
							</h3>
						</form>
						<br><br>
		";
	if(isset($_POST["logout"]))
	{
		//session_name('placement');
		unset($_SESSION['principal']);
		session_destroy();
		echo "<script language='javascript'>window.location='index.php';</script>";
	}
	if(isset($_POST["submit"]))
	{
		if($_POST['rollno']!=null)
		{
			session_start();
			if(!isset($_SESSION['principal'])){
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
								
								
								echo "<br><h1>Marks Details:<h1>";
								$sql="SELECT stu_coe.CourseId, Coe.Cname, Grade 
								from coe join stu_coe on coe.CourseId=stu_coe.CourseId 
								where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Course Id</th>
										<th style='padding: 5px;font-size: 20px;'>Course Name</th>
										<th style='padding: 5px;font-size: 20px;'>Grade</th>
									</tr>";
									while($row = mysqli_fetch_array($retval))
									{
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['CourseId']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Cname']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Grade']}</td>
											</tr>
										";
									}
								echo"</table>";
								
								
								echo "<br><h1>Library Details:<h1>";
								$sql="SELECT BookName
										from library join takesbook on library.BookId=takesbook.BookId
										where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Books Taken</th>
									</tr>";
									$count=0;
									while($row = mysqli_fetch_array($retval))
									{
										$count++;
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['BookName']}</td>
											</tr>
										";
									}
								echo"<tr><th>Total:$count</th></tr></table>";
								


								echo "<br><h1>Placement Details:<h1>";
								$sql="select CompanyName, Result
										from std_placement_details
										where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Company Name</th>
										<th style='padding: 5px;font-size: 20px;'>Result</th>
									</tr>";
									//$count=0;
									while($row = mysqli_fetch_array($retval))
									{
										//$count++;
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['CompanyName']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['Result']}</td>
											</tr>
										";
									}
								echo"</table>";
								

								echo "<br><h1>Bus Details:<h1>";
								$sql="SELECT BusNo, SeatNo
										from stu_bus
										where RollNo='$rno'";
								$retval = mysqli_query($conn, $sql);
								echo "
								<table border='1'>
									<tr>
										<th style='padding: 5px;font-size: 20px;'>Bus Number</th>
										<th style='padding: 5px;font-size: 20px;'>Seat Number</th>
									</tr>";
									//$count=0;
									while($row = mysqli_fetch_array($retval))
									{
										//$count++;
										echo "
											<tr>
												<td style='padding: 10px;font-size: 20px;'>{$row['BusNo']}</td>
												<td style='padding: 10px;font-size: 20px;'>{$row['SeatNo']}</td>
											</tr>
										";
									}
								echo"</table>";	
							}
						}
	echo "
				</center>
				<!--a href='logout.php' class='sub_btn'>Logout</a-->
			</body>
		</html>
	"
		
?>