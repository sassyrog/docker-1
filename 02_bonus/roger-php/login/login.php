<?php
require("../config/init.php");
require("../config/dataHandler.php");

if (isset($_SESSION)) {
	session_unset();
	session_destroy();
}

$g = new General();
$g->CheckRequest("XMLHttpRequest");

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

	$email =		isset($_POST["email"])? $_POST["email"] : "";
	$password =	isset($_POST["password"])? $_POST["password"] : "";
	$initClass = new Init("GetSchwifty");
	$db = $initClass->getDB();
	if ($db) {
		if (!$email && !preg_match('/^[A-Za-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{1,4}[^\\S]+$/', $email))
			$response["form_error"] .= "<li>Email has incorrect formart</li>";
		if(!$response["form_error"]) {
			$dh = new DataHandler($db);
			$validate = $dh->ValidateLogin($email, $password);
			if (!$validate) {
				$response["form_error"] .= "<li>Invalid email or password</li>";
			} else {
					session_start();
					$_SESSION["loggedin"] = 1;
					$_SESSION["email"] = $email;
					$_SESSION["Role"] = $validate["Role"];
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
	<div class="mx-3">
		<div class="card">
			<div class="card-header text-center h4">Login</div>
			<div class="card-body pt-1">
				<div class="col-sm-12 px-0 pb-2 mx-auto">
        	<small>
						<ul  id="form-error" class="p-0 px-1">
						</ul>
					</small>
				</div>
				<form id="login-form">
					<div class="form-row justify-content-center">
						<div class="form-group col-md-8 mb-0">
							<label for="email" class="col-form-label col-form-label-sm pt-0">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Email" />
						</div>
						<div class="form-group col-md-8 mb-0">
							<label for="password" class="col-form-label col-form-label-sm pt-0">Password</label>
							<input type="password" class="form-control" id="password" placeholder="Password" name="password" />
						</div>
						<div class="form-group col-md-6 mt-4">
							<input type="submit" class="btn btn-block" value="Submit" name="submit" disabled="disabled" />
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		formValidator("#login-form", "#form-error");

		$("#login-form input").on("focus", function() {
			$(this).parent().find("label").animate({
						opacity: 1
					}, 200);
			// formValidator($(this), "#form-error")
		});
		$("input").focusout(function() {
			$("#login-form").find("label").animate({
						opacity: 0
					}, 200);
		});

		$("#login-form").submit(function(e) {
			e.preventDefault();
			var formData = $(this).serializeObject();
			formData["submit"] = "ok";
			$.ajax({
				type: "POST",
				url: "/login/login.php",
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
							console.log(response);
					} catch (e) {
							console.log(res);
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
