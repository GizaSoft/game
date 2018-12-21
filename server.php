<?php 
session_start();

	$login = "";     // username
	$password = ""; // password

	include('db_connect.php');

	if(isset($_POST['submit']))
	{
		$login = mysqli_real_escape_string($db, $_POST['login']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		
		if($login!="" && $password!="" )
			{
				$sql="SELECT * FROM `admin` WHERE login='$login' AND parol='$password' ";
					$result = mysqli_query($db, $sql);
					$row = mysqli_fetch_array($result);
					$count = mysqli_num_rows($result);

					if($count==1)
						{
							$_SESSION['login'] = $login;
							header("location:words.php");
						}
					else
						{
								echo "<h2><center>XATOLIK</center></h2><br><a type='submit' href='page-login.php'>Qaytish Login </a>
								";
							// failed
						}
		  	}
	}
?>