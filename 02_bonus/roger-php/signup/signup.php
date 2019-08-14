<?php
require("../config/init.php");
require("../config/dataHandler.php");

if (isset($_SESSION)) {
	session_destroy();
}

$g = new General();
$g->CheckRequest("xmlhttpRequest");
$response = array("form_error" => "", "error" => "", "success" => "");
if (isset($_POST["submit"]) && $_POST["submit"] == "ok") {
	unset($_POST["submit"]);

	foreach ($_POST as $key => $value) {
		if(!$value) {
			$response["form_error"] .= "<li>".ucfirst($key)." is too short or empty</li>";
		}
	}
	if ($response["form_error"]) {
		echo json_encode($response);
		exit;
	}

	$firstname =	isset($_POST["firstname"])? $_POST["firstname"] : "";
	$lastname =		isset($_POST["lastname"])? $_POST["lastname"] : "";
	$username =		isset($_POST["username"])? $_POST["username"] : "";
	$email =			isset($_POST["email"])? $_POST["email"] : "";
	$password1 =	isset($_POST["password1"])? $_POST["password1"] : "";
	$password2 = 	isset($_POST["password2"])? $_POST["password2"] : "";
	$initClass = new Init("GetSchwifty");
	$db = $initClass->getDB();
	if ($db) {
		if (!$firstname && !preg_match('/^[a-zA-Z]\'?[-a-zA-Z]+$/', $firstname))
			$response["form_error"] .= "<li>Firstname has incorrect formart</li>";
		if (!$lastname && !preg_match('/^[a-zA-Z]\'?[-a-zA-Z]+$/', $lastname))
			$response["form_error"] .= "<li>Lastname has incorrect formart</li>";
		if (!$username && !preg_match('/^[a-zA-Z0-9_]+$/', $username))
			$response["form_error"] .= "<li>Username has incorrect formart</li>";
		if (!$email && !preg_match('/^[A-Za-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{1,4}[^\\S]+$/', $email))
			$response["form_error"] .= "<li>Email has incorrect formart</li>";
		if (!$password1 && $password1 != $password2)
			$response["form_error"] .= "<li>Passwords don't match</li>";
		if(!$password1 && strlen($password1) < 7)
			$response["form_error"] .= "<li>Password too short</li>";
		if(!$password1 && !preg_match('/[a-z]{2,}/', $password1) &&
			!preg_match('/[0-9]{1,}/', $password1) && 
			!preg_match('/[A-Z]{1,}/', $password1))
			$response["form_error"] .= "<li>Password too weak</li>";

		if(!$response["form_error"]) {
			$dh = new DataHandler($db);
			$check = $dh->CheckUserExists($username, $email);
			if ($check) {
				$response["form_error"] .= "<li>".$check." already exists</li>";
			} else {
				$register = $dh->RegisterUser($firstname, $lastname, $username, $email, $password1);
				print_r($register);
				if (!$register) {
					echo "Something went wrong";
					exit;
				} else {
					session_start();
					$_SESSION["loggedin"] = 1;
					$_SESSION["user"] = $username;
					exit;
				}
				exit;
			}
		}
	} else {
			echo "Something went wrong";
			exit;
	}
	echo json_encode($response);
	exit;
}
?>
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header text-center h4">Sign Up</div>
			<div class="card-body pt-1">
				<div class="col-sm-12 px-0 pb-2 mx-auto">
        	<small>
						<ul  id="form-error" class="p-0 px-1">
						</ul>
					</small>
				</div>
				<form id="signup-form">
					<div class="form-row justify-content-center">
						<div class="form-group col-md-6 mb-0">
							<label for="username" class="col-form-label col-form-label-sm pb-0">Username</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" />
						</div>
						<div class="form-group col-md-6 mb-0">
							<label for="email" class="col-form-label col-form-label-sm pb-0">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
						</div>
						<div class="form-group col-md-6 mb-0">
							<label for="firstname" class="col-form-label col-form-label-sm pb-0">Firstname</label>
							<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" />
						</div>
						<div class="form-group col-md-6 mb-0">
							<label for="lastname" class="col-form-label col-form-label-sm pb-0">Lastname</label>
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Lastname" />
						</div>
						<div class="form-group col-md-6 mb-0">
							<label for="password1" class="col-form-label col-form-label-sm pb-0">Password</label>
							<input type="password" class="form-control" id="password1" placeholder="Password" name="password1" />
							<div class="meter form-text">
								<div class="meter-bar">
									<div>
										<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="5px" >
										<defs> 
										<linearGradient id="lgrad" x1="0%" y1="50%" x2="100%" y2="50%" > 
										<stop offset="0%" style="stop-color:rgb(255,0,0);stop-opacity:1" />
										<stop offset="49%" style="stop-color:rgb(255,245,59);stop-opacity:1" />
										<stop offset="100%" style="stop-color:rgb(0,255,38);stop-opacity:1" />
										</linearGradient> 
										</defs>
										<rect x="0" y="0" width="100%" height="100%" fill="url(#lgrad)"/>
										</svg>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-6 mb-0">
							<label for="password2" class="col-form-label col-form-label-sm pb-0">Confirm Password</label>
							<input type="password" class="form-control" id="password2" placeholder="Cornfirm Password" name="password2" />
						</div>
						<div class="form-group col-md-6 mt-4">
							<input type="submit" class="btn btn-block disabled" disabled="disabled" value="Submit" name="submit" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		formValidator("#signup-form", "#form-error");

		$("#signup-form input").on("input", function() {
			$(this).parent().find("label").animate({
						opacity: 1
					},200);
		});
		$("input").focusout(function() {
			$("#signup-form").find("label").animate({
						opacity: 0
					},200);
		});

		$("#signup-form").submit(function(e) {
			e.preventDefault();
			var formData = $(this).serializeObject();
			formData["submit"] = "ok";
			$.ajax({
				type: "POST",
				url: "/signup/signup.php",
				data: formData,
				success: function (res) {
					try {
							var response = JSON.parse(res);
							if (response.form_error) {
								$("#form-error").html(response.form_error);
							} else if(response.error) {
							} else {
								window.location.href = "http://"+window.location.hostname;
							}
					} catch (e) {
						if(res.trim()) {
							$("#body-container").prepend("<small>"+res+"</small>");
						} else {
							window.location.href = "http://"+window.location.hostname;
						}
					}
				}
			});
		});
	});
</script>
