<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="author" content="Muktodhara Technology Limited">
	<meta name="description" content="Product Management Software">
	<meta name="keywords" content="Product Management Software by Muktodhara Technology Limited">

	<!-- Site ICON LINK -->
	<link rel="icon" href="<?= asset('public/icon.png'); ?>">

	<title>Login | Mukto Product Management</title>

	<!-- ICON AND FONT CDN LINK (Please Always Use The Updated CDN) -->
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

	<!-- Bootstrap CSS CDN LINK (Please Always Use The Updated CDN) -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Bootstrap JS CDN LINK (Please Always Use The Updated CDN) -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<!-- CUSTOM CSS LINK -->
	<style>
		html {
			overflow-y: scroll;
			overflow-x: hidden;
			background: #464656;
		}

		body {
			margin: 0;
			padding: 0;
			font-size: 13px;
			font-family: Calibri;
			color: #333;
			background-color: #f9f9f9;
			min-width: 320px;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin: 0;
			padding: 10px 0;
			font-weight: normal;
		}

		a {
			color: #fff;
			text-decoration: none;
			cursor: pointer;
			transition: 0.5s all;
		}

		/*a:focus, a:hover,a:active {
		text-decoration:none;
		color:#502aff;
		transition: 0.5s all;
	}*/

		p {
			font-size: 13px;
			text-align: justify;
			margin: 0;
			padding: 5px 0;
		}


		.logo {
			margin-top: 20px;
		}

		/*.logo img {

		height: 90px !important;
		width: auto !important;
		padding: 10px 0;

	}*/

		.logo_text {
			font-size: 40px;
			font-weight: 300;
			color: #fff;
			font-family: Ubuntu;

		}

		.logo_text p {
			padding: 0;
			text-align: left;
			line-height: 0.7;
			color: #fff;
		}

		.btn {
			width: 100px;
			margin: 0 auto;
		}

		/**********  body  ***********/
		.login_page {
			width: 100%;
			background: #000 url("<?= asset('public/medical2.jpg'); ?>") no-repeat fixed center;
			background-size: 100% 100%;
			float: left;
			height: auto;

		}


		.backoverlay {
			background: #1a182d;
			opacity: 0.8;
			padding: 100px 0;

		}


		/*
	 * Card component
	 */

		.login-container.login {
			max-width: 350px;
			padding: 40px 40px;
		}

		.login {
			background-color: #000;
			padding: 20px 25px 30px;
			margin: 0 0 80px;
			margin-top: 50px;
			-moz-border-radius: 2px;
			-webkit-border-radius: 2px;
			border-radius: 10px;
			-moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			-webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
			border: 10px solid #502aff;
			color: #fff;
		}

		.profile-img-login {
			width: 96px;
			height: 96px;
			margin: 0 auto 10px;
			display: block;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
			border: 4px solid #502aff;
		}

		.company-title {
			text-align: right;
			color: #fff;
			padding: 20px 0 30px;
			margin-top: 50px;


		}


		.company-title h1 {
			border-bottom: 4px solid #502aff;
			font-size: 70px;
			text-transform: uppercase;

		}

		.company-title h1>span {
			font-size: 40px;

		}

		.company-title p {
			font-size: 25px;
			text-align: right;
		}


		/**********   Class Helpers   ***********/

		.white {
			color: #fff;
		}

		.number {
			font-family: sans-serif;
		}

		.border {
			border: 1px solid lightgrey;
		}

		.border_r {
			border-right: 1px solid lightgrey;
		}

		.border_l {
			border-left: 1px solid lightgrey;
		}

		.border_t {
			border-top: 1px solid lightgrey;
		}

		.border_b {
			border-bottom: 1px solid lightgrey;
		}

		.left {
			float: left;
		}

		.right {
			float: right;
		}

		.clear,
		.clearfx {
			clear: both;
		}



		.no_border {
			border: none;
		}

		.no_margin {
			margin: 0;
		}

		.no_padding,
		.no-padding {
			padding: 0;
		}

		.bottom_no_pad {
			padding-bottom: 0;
		}

		.top_margin {
			margin-top: 15px;
		}

		.bottom_margin {
			margin-bottom: 15px;
		}

		.bottom_margin_small {
			margin-bottom: 7px;
		}

		.top_padding {
			padding-top: 10px;
		}

		.bottom_padding {
			padding-bottom: 15px;
		}

		.centerText {
			text-align: center;
		}

		.leftText {
			text-align: left !important;
		}

		.rightText {
			text-align: right;
		}

		.top_no_pad {
			padding-top: 0;
		}

		.left_no_pad {
			padding-left: 0;
		}


		/***********  Media Query Responsive  ***************/



		@media screen and (max-width: 991px) {

			.company-title h1 {
				font-size: 60px;

			}

			.company-title h1>span {
				font-size: 35px;

			}
		}

		@media screen and (max-width: 767px) {
			.logo img {

				height: auto !important;
				width: 300px !important;

			}

			.login {
				margin: 50px auto 80px;
			}

		}

		@media screen and (max-width: 560px) {

			.logo_text {
				font-size: 30px;
			}
		}

		@media screen and (max-width: 375px) {
			.logo_text {
				font-size: 20px;
			}
		}
	</style>

</head>

<body>
	<section class="login_page">
		<div class="col-md-12 col-sm-12 col-xs-12 no_padding">
			<div class="col-md-12 col-sm-12 col-xs-12 no_padding backoverlay">
				<div class="container">
					<div class="col-md-12 col-sm-12 col-xs-12 logo">

						<!-- <img src="images/mtl-match-logo.png" alt="images"> -->
						<p class="logo_text"><i class='fas fa-stethoscope'></i>&nbsp; Pharmacy Management

					</div>
					<div class="col-md-12 col-sm-12 col-xs-12 no_padding">

						<div class="col-md-12 col-sm-12 col-xs-12">

							<br>
							<br>

						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 ">
							<div class="login login-container">

								<img class="profile-img-login" src="<?= asset('public/user.png'); ?>" />

								<p id="profile-name" class="profile-name-login"></p>

								<div class="form-signin">


									<?php
									$exception = Session::get('exception');
									if (isset($exception)) {
										echo '<h5 class="text-center" style="color:red;">' . $exception . '</h5>';
										Session::put('exception', '');
									}
									?>


									<?php
									$message = Session::get('message');
									if (isset($message)) {
										echo '<h5 class="text-center">' . $message . '</h5>';
										Session::put('message', '');
									}
									?>


									{!! Form::open(['url' => '/admin_login','method'=>'post']) !!}

									<label for="email">E-mail</label>

									<input name="admin_email" type="email" id="email" class="form-control" placeholder="Email address" required>

									<br>

									<label for="password">Password</label>

									<input name="admin_password" type="password" id="password" class="form-control" placeholder="Password" required>

									<br>
									<!--  <div id="remember" class="checkbox">
											<label>
												<input type="checkbox" value="remember-me"> Remember me
											</label>
										</div> -->

									<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>


									{!! Form::close() !!}

								</div>


							</div>
						</div>


						<div class="col-md-6 col-sm-6 hidden-xs">
							<div class="col-md-12 col-sm-12 col-xs-12 company-title">
								<br>
								<br>
								<br>
								<br>
								<h1>Move Work <span>Forword</span></h1>
								<p>Making Digital</p>
								<p><a href="http://muktodharaltd.com/" target="_blank">Muktodhara Technology Limited</a></p>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">

							<br>
							<br>
							<br>
							<br>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>

</html>