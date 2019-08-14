<?php
session_start()
?>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<title>Document</title>

		<!-- Boostrap 4.3 -->
		<link rel="stylesheet" href="/public/bootstrap/css/bootstrap.css" />
		<!-- Fontawesome 5 Free -->
		<link rel="stylesheet" href="/public/fontawesome/css/all.css" />
		<link rel="stylesheet" href="/public/css/style.css" />
		<link rel="stylesheet" href="/public/css/select-menu.css">
		<script src="/public/js/jquery.js"></script>
		<script src="/public/popper.js-1.15.0/dist/umd/popper.js"></script>
		<script src="/public/bootstrap/js/bootstrap.js"></script>
		<script src="/public/js/main.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-expand-md r-shadow">
			<a class="navbar-brand" href="#"><img width="50" class="d-inline-block align-top" src="https://seeklogo.com/images/M/marvel-comics-logo-31D9B4C7FB-seeklogo.com.png" alt="" srcset=""/></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarText">
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="home" data-toggle="tooltip" title="Home">
							<i class="fas fa-home"></i>
						</a>
					</li>
					<?php
          if (isset($_SESSION) && isset($_SESSION["loggedin"])) {
          ?>
					<li class="nav-item">
						<a class="nav-link" href="logout" data-toggle="tooltip" title="Logout">
							<i class="fas fa-sign-out-alt"></i>
						</a>
					</li>
					<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link" href="login" data-toggle="tooltip" title="Login">
							<i class="fas fa-sign-in-alt"></i>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="signup" data-toggle="tooltip" title="Signup">
							<i class="fas fa-user-plus"></i>
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
    </nav>
		<div class="root">
			<div class="container-fluid mt-3" id="body-container"></div>
			<div id="loader">
				<div class="spinner"><i class="fas fa-spinner fa-spin"></i></div>
			</div>
		</div>
	</body>
</html>
