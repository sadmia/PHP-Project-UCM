<?php require('connectDB.php');

	if (isset($_GET['id'])) {
		$linkId = $_GET['id'];

	    $sqlData = "SELECT `ID`, `FullName`, `EmailAddress`, `PhoneNumber`, `Password`, `Gender` FROM data WHERE ID = $linkId";
	    $sqlDataQuery = mysqli_query($connectDB, $sqlData);
	    $sqlDataQueryArrayData = mysqli_fetch_array($sqlDataQuery);

	    $idDB = $sqlDataQueryArrayData['ID'];
	    $fullNameDB = $sqlDataQueryArrayData['FullName'];
	    $emailDB = $sqlDataQueryArrayData['EmailAddress'];
	    $phoneNumberDB = $sqlDataQueryArrayData['PhoneNumber'];
	    $passwordDB = $sqlDataQueryArrayData['Password'];
	    $genderDB = $sqlDataQueryArrayData['Gender'];
	}


	if (isset($_POST['update'])) {
		$fullName = salitize($_POST['fullName']);
		$emailAddress = salitize($_POST['emailAddress']);
		$phoneNumber = salitize($_POST['phoneNumber']);
		$password = salitize($_POST['password']);
		$gender = salitize($_POST['gender']);

		$regExp = "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/";
		$numberRegExp = "/01[3,4,5,6,7,8,9][0-9]{8}$/";

		if (!empty($fullName) && !empty($emailAddress) && !empty($phoneNumber) && !empty($password) && !empty($gender)) {
			if ((strlen($fullName) >= 3 && strlen($fullName) <=15) && preg_match($regExp, $emailAddress) && preg_match($numberRegExp, $phoneNumber) && (strlen($password) >= 6 && strlen($password) <= 20)) {
				
				$sqlData = "UPDATE data SET `FullName`= '$fullName',`EmailAddress`='$emailAddress',`PhoneNumber`= '$phoneNumber',`Gender`= '$gender',`Password`= '$password' WHERE ID = $linkId";
		    	$sqlDataQuery = mysqli_query($connectDB, $sqlData);
		    	header("Refresh:0");
			header("Location: index.php");

			}
		}
	}

	function salitize($data){
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

?>




<!DOCTYPE html>
<html>
	<head>

		<title>Edit Data</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/all.min.css">
		<link rel="stylesheet" type="text/css" href="css/edit_data.css">

	</head>

	<body>


		<section class="centerDataInput">

			<a href="index.php" id="closeBtn"><i class="fa-solid fa-circle-xmark"></i></a>

			<h5 class="haderText">Update Infarmation</h5>

			<form class="formClass" method="post" action="">
				<label><input id="fullName" type="text" name="fullName" placeholder="Full Name" value="<?php echo $fullNameDB;?>"></label>
				<label><input id="emailAddress" type="email" name="emailAddress" placeholder="Email Address" value="<?php echo $emailDB;?>"></label>
				<label><input id="phoneNumber" type="number" name="phoneNumber" placeholder="Phone Number (01)" value="0<?php echo $phoneNumberDB;?>"></label>
				<div class="passView">
					<input id="passBox" type="password" name="password" placeholder="Password" value="<?php echo $passwordDB;?>">
					<i id="hideViewBtn" class="fa-solid fa-eye-slash"></i>
				</div>

				<div class="genderDiv">
					<?php if ($genderDB == "Mail") { ?>
						<label><input id="mailGender" type="radio" name="gender" value="Mail" checked> Mail</label>
						<label><input id="femailGender" type="radio" name="gender" value="Femail"> Femail</label>
						<span class="worningTextRed">Gender Empty!</span>
					<?php } else if ($genderDB == "Femail") { ?>
						<label><input id="mailGender" type="radio" name="gender" value="Mail"> Mail</label>
						<label><input id="femailGender" type="radio" name="gender" value="Femail" checked> Femail</label>
						<span class="worningTextRed">Gender Empty!</span>
					<?php }?>
				</div>

				<input type="submit" class="button" name="update" id="updateBtn" value="Update">
			</form>

		</section>


	<script src="js/edit_data.js"></script>
	</body>
</html>
