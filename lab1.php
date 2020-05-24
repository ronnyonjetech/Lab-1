<?php	
	include_once 'user.php';
	include_once 'fileUploader.php';
	include_once 'DBConnector.php';
	$conn=new DBConnector;

	if(isset($_POST['btn-save'])) {
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$path=$_FILES["fileToUpload"]["name"];
		

		$user = new User($first_name, $last_name, $city,$username,$password,$path);
        $uploader=new FileUploader();//lab2 of 3
		

        if (!$user->valiteForm()) {
        	$user->createFormErrorSessions();
        	header("Refresh:0");
        	die();
        }



		$res = $user->save();
		/*lab2part3*/
		$file_upload_response=$uploader->uploadFile();
		//check isf operation save took place
		/*if ($res && $file_upload_response) {
			echo "Save Operation was successful for file upload";
		}else{
			echo "save operation wasn't successful for file upload";
		}
		
		if($res) {
			echo "Save operation was successful";
		} else {
			echo "An error occured!";
		}*/
		//$user->readAll();
	}


?>
<html>
<head>
<title>Lab 1</title>
	<script type="text/javascript" src="validate.js"></script>
	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>
	<form method="POST" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']  ?>"enctype="multipart/form-data">
		<table align="center">
			<tr>
				<td><input type="text" name="first_name" required placeholder="First Name"/></td>
			</tr>
			<tr>
				<td><input type="text" name="last_name" placeholder="Last Name"/></td>
			</tr>
			<tr>
				<td><input type="text" name="city_name" placeholder="City"/></td>
			</tr>
			<tr>
				<td><input type="text" name="username"placeholder="username"/></td>
			</tr>
			<tr>
				<td><input type="password" name="password"placeholder="password"/></td>
			</tr>
			<tr>
				<td>Profile image:<input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>
			<tr>
				<td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
			</tr>
			<tr>
				<td><a href="login.php">Login</a></td>
			</tr>
			<tr>
				<td>
					<div id="form-errors">
						<?php
						session_start();
						if (!empty($_SESSION['form_errors'])) {
							echo "".$_SESSION['form_errors'];
							unset($_SESSION['form_errors']);
						}
						?>
					</div>
				</td>
			</tr>
		</table>		
	</form>
</body>
</html>