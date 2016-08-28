<?php
session_start();
include 'functions.php';
$connection=db_connect();

if(isset($_POST['submit'])){
	$user =$_POST['username'];
	$query="SELECT * FROM user_data WHERE username='$user'";
	$result = mysqli_query($connection, $query) or die("Dude! Error: ". mysqli_error($connection));
	$check_user=mysqli_num_rows($result);
	if($check_user>0){
		echo "this username is already taken";    
	}

	else {
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$username=$_POST['username'];
		$age=$_POST['age'];
		$sex=$_POST['sex'];
		$wt=$_POST['wt'];
		$ht1=$_POST['ht1'];
		$ht2=$_POST['ht2'];
		$ht= $ht1*12+$ht2;
		$bmi=$wt/$ht*$ht*0.00064516;

		$blood=$_POST['blood'];
		$email=$_POST['email'];
		$encrypt=sha1($_POST['password1']);
		$password=$encrypt;
	
		$query="INSERT INTO `user_data` (`firstname`,`lastname`,`username`,`age`,`sex`,`weight`,`height`,`blood`,`email`,`bmi`,`password`) VALUES ('$firstname', '$lastname','$username', $age, '$sex', $wt, $ht, '$blood', '$email',$bmi ,'$encrypt')";
		$result = mysqli_query($connection, $query);
		echo "$query";
		if(!$result){
			printf("%s",mysqli_error($connection));
		}
	  // header('location:dri.php');
     }
}
?>


<html>
<head>
<title></title>
<script type="text/javascript" language="javascript">
function validate(){
	var firstname = document.getElementById("firstname").value;
	var lastname = document.getElementById("lastname").value;
	var username = document.getElementById("username").value;
	var age = document.getElementById("age").value;
	var sex = document.getElementById("sex").value;
	var wt = document.getElementById("wt").value;
	var ht1 = document.getElementById("ht1").value;
	var ht2 = document.getElementById("ht2").value;
	var blood = document.getElementById("blood").value;
	var email = document.getElementById("email").value;
	var password1 = document.getElementById("password1").value;
	var password2 = document.getElementById("password2").value;	
	var nameReg = /^[a-zA-Z ]+$/;
	var emailReg = /^\w([\.-]?\w)*@\w([\.-]?\w)*(\.\w{2,3})+$/;
	
	if(firstname == "" || lastname == "" || username == "" || age == "" ||wt == "" || ht1 == ""||ht2=="" || blood == ""|| email == "" ){
		alert("Some fields are missing");
		return false;
	}
	else if(!firstname.match(nameReg)){
		alert("Enter proper name");
		return false;
	}
	else if(!lastname.match(nameReg)){
		alert("Enter proper name");
		return false;
	}
	else if(isNaN(age)){
		alert("age should be all numeric.");
		return false;
	}
	else if(isNaN(ht1)){
		alert("height should be all numeric.");
		return false;
	}
	else if(isNaN(ht2)){
		alert("height should be all numeric.");
		return false;
	}
	else if(!password1.match(password2)){
		alert("passwords are different");
		return false;
	}
	else if(!email.match(emailReg)){
		alert("Enter proper email address");
		return false;
	}
	
	else if(!document.getElementById("male").checked && !document.getElementById("female").checked){//if used in checkbox or radio button.
		alert("Check the gender")
		return false;
	}
	
	
}
</script>


</head>
<body>
<form name="registration" id="registration" method="post" action="register.php" onsubmit=" return validate(); ">
First Name:<input type="text" name="firstname" id="firstname"><br \>
Last Name:<input type="text" name="lastname" id="lastname"><br \>
Username:<input type="text" name="username" id="username"><br \>
Password:<input type="text" name="password1" id="password1"><br \>
Re-enter Password:<input type="text" name="password2" id="password2"><br \>
Age:<input type="text" name="age" id="age"><br \>
Sex:<input type="radio" name="sex" id="sex" value="male">Male<br \>
	<input type="radio" name="sex" id="sex" value="femlae">Female<br \>

Weight:<input type="text" name="wt" id="wt"><br \>
Height:<input type="text" name="ht1" id="ht1">ft<br \>
		<input type="text" name="ht2" id="ht2">in<br \>
Blood Group:<input type="text" name="blood" id="blood"><br \>
Email:<input type="text" name="email" id="email"><br \>
<input type="submit" value="submit" name="submit" id="submit">
<input type="reset" value="reset">
</form>

</body>
</html>
