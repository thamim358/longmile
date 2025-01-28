<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/phpmailer/src/Exception.php';
require 'include/phpmailer/src/PHPMailer.php';
require 'include/phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    function sanitizeInput($input) {
        $input = trim($input);
        $input = strip_tags($input);
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        return $input;
    }

    $name = sanitizeInput($_POST['name'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $subject = sanitizeInput($_POST['subject'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');

    $errors = array();
    if (empty($name)) $errors[] = "Name is required";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
    if (empty($subject)) $errors[] = "Subject is required";
    if (empty($message)) $errors[] = "Message is required";

    if (empty($errors)) {
        try {
            $dsn = "mysql:host=localhost;dbname=longmile;charset=utf8mb4";
            $pdo = new PDO($dsn, 'nakulan', 'nakulan@2023');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO contact (Name, Phone, Email, Subject, Message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $email, $subject, $message]);

            $mail = new PHPMailer(true);
            
            $mail->Debugoutput = function($str, $level) {
                error_log("SMTP Debug: $str");
            };

            $mail->isSMTP();
            $mail->Host = 'mail.longmilefashions.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'contactus@longmilefashions.com';
            $mail->Password = 'Longmilenakulan@1'; 


            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->Timeout = 30;
            $mail->SMTPKeepAlive = true;
            
            // Recipients
            $mail->setFrom('contactus@longmilefashions.com', 'Longmile Fashions');
            $mail->addAddress('contactus@longmilefashions.com', 'Longmile Fashions Team');
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Contact Form Submission: ' . $subject;
            $mail->Body = "
                <html>
                <head>
                    <style>
                        body { font-family: Arial, sans-serif; }
                        .container { padding: 20px; }
                        .field { margin-bottom: 10px; }
                        .label { font-weight: bold; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <h2>New Contact Form Submission</h2>
                        <div class='field'>
                            <span class='label'>Name:</span> {$name}
                        </div>
                        <div class='field'>
                            <span class='label'>Phone:</span> {$phone}
                        </div>
                        <div class='field'>
                            <span class='label'>Email:</span> {$email}
                        </div>
                        <div class='field'>
                            <span class='label'>Subject:</span> {$subject}
                        </div>
                        <div class='field'>
                            <span class='label'>Message:</span><br>
                            " . nl2br(htmlspecialchars($message)) . "
                        </div>
                    </div>
                </body>
                </html>
            ";
            $mail->AltBody = "New Contact Form Submission\n\nName: $name\nPhone: $phone\nEmail: $email\nSubject: $subject\nMessage: $message";

            if (!$mail->send()) {

                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                $mail->send();
            }
            
            echo '<script>
                alert("Thank you! Your message has been sent successfully.");
                window.location.href = "contact.php";
            </script>';
            exit;

        } catch (Exception $e) {
            error_log("Detailed Mail Error: " . $e->getMessage());
            error_log("SMTP Debug Info: " . $mail->ErrorInfo);
            
            $errorMessage = "Mail Error Details:\n";
            $errorMessage .= "- Error Message: " . $e->getMessage() . "\n";
            $errorMessage .= "- SMTP Error: " . $mail->ErrorInfo;
            
            echo '<script>
                alert("An error occurred while sending the email. Technical details:\n\n' . addslashes($errorMessage) . '");
                window.location.href = "contact.php";
            </script>';
            exit;
        }
    } else {
        $errorMessage = "Please correct the following errors:\n";
        $errorMessage .= implode("\n", $errors);
        echo '<script>
            alert("' . addslashes($errorMessage) . '");
            window.location.href = "contact.php";
        </script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
	<head>

		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="SemiColonWeb" />

		<!-- Favicon -->
		<link rel="shortcut icon" href="one-page/images/logo/faviconbluebg.jpg" type="image/x-icon" />

		<!-- Stylesheets
		============================================= -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap"
			rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="css/dark.css" type="text/css" />

		<!-- Option 1: Include in HTML -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

		<!-- Home Demo Specific Stylesheet -->
		<link rel="stylesheet" href="one-page/interior-design.css" type="text/css" />

		<link rel="stylesheet" href="css/font-icons.css" type="text/css" />
		<link rel="stylesheet" href="css/animate.css" type="text/css" />
		<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

		<!-- <link rel="stylesheet" href="one-page/css/fonts.css" type="text/css" /> -->

		<link rel="stylesheet" href="css/custom.css" type="text/css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!-- <link rel="stylesheet" href="css/colors.php?color=1c85e8" type="text/css" /> -->

		<!-- Document Title
		============================================= -->
		<title>Longmile Fashions</title>

	</head>

	<body class="stretched side-push-panel">

	

		<!-- Document Wrapper
		============================================= -->
		<div id="wrapper" class="clearfix">

			<!-- Header
			============================================= -->
			<header id="header" class="full-header header-size-md" data-sticky-shrink="false">
				<div id="header-wrap" style="border: none;">
					<div class="container">
						<div class="header-row justify-content-between">
	
							<!-- Logo
								============================================= -->
							<div id="logo" class="me-lg-0" style="border: none;">
								<a href="index.php" class="standard-logo">
									<img src="one-page/images/logo/longmile-logo.png" alt="Logo">
								</a>
								<a href="index.php" class="retina-logo">
									<img src="one-page/images/logo/longmile-logo.png" alt="Logo">
								</a>
							</div><!-- #logo end -->
	
							<div class="header-misc">
	
								<!-- Top Search
									============================================= -->
								
	
							</div>
	
							<div id="primary-menu-trigger">
								<svg class="svg-trigger" viewBox="0 0 100 100">
									<path
										d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20">
									</path>
									<path d="m 30,50 h 40"></path>
									<path
										d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20">
									</path>
								</svg>
							</div>
	
							<!-- Primary Navigation
								============================================= -->
							<nav class="primary-menu with-arrows">
	
								<ul class="menu-container" style="border: none;">
									<li class="menu-item">
										<a href="index.php" class="menu-link" data-href="#section-services">
											<div>HOME</div>
										</a>
									</li>
									<li class="menu-item">
										<a href="aboutus.html" class="menu-link " data-href="#section-works">
											<div>ABOUT US</div>
										</a>
									</li>
									<li class="menu-item">
										<a href="capabilities.html" class="menu-link " data-href="#section-about">
											<div>CAPABILITIES</div>
										</a>
									</li>
									<li class="menu-item">
										<a class="menu-link" data-href="#section-about">
											<div>PRODUCTS</div>
										</a>
										<ul class="sub-menu-container">
											<li class="menu-item"><a class="menu-link" href="menswear.html">
													<div>Menswear</div>
												</a>
											</li>
											<li class="menu-item"><a class="menu-link" href="womenswear.html">
													<div>Womenswear</div>
												</a>
											</li>
											<li class="menu-item"><a class="menu-link" href="childrenswear.html">
													<div>Childrenswear</div>
												</a>
											</li>
										</ul>
									</li>
									<li class="menu-item">
										<a href="commitment.html" class="menu-link" data-href="#section-about">
											<div>COMMITMENT</div>
										</a>
									</li>
									<li class="menu-item">
										<a href="contact.html">
											<button class="button fw-normal" type="submit" style="border-radius: 10px;">Contact US</button>
										</a>
									</li>
								</ul>
	
							</nav><!-- #primary-menu end -->
	
						</div>
					</div>
				</div>
				<div class="header-wrap-clone"></div>
			</header><!-- #header end -->

			<!-- Slider
			============================================= -->
			<section class="slider-element min-vh-35" style="background: linear-gradient(178deg, rgba(201, 234, 252, 0.51) 14.9%, rgba(139, 192, 216, 0.73) 80%) no-repeat center center / cover;">
				<div class="slider-inner">
					<div class="container">
						<div class="mx-auto" style="padding-top: 6rem;">
							<div class="emphasis-title slider-head ">
								Contact us
							</div>
						</div>
					</div>					
				</div>
			</section>

			<!-- Content
			============================================= -->
			<section id="content">
				<div class="content-wrap pt-0 pb-0 clearfix">
					<section id="contact">
						<div class="container px-4">
							<div class="section pt-4 px-3 pb-4" style="border-radius: 30px">
							<h3 class="about-title m-0 center">Send us an Email</h3>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="row mb-0 px-5 mt-4" action="contact.php" method="post">

									<!-- <div class="form-process bg-transparent">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div> -->

									<div class="col-md-6 form-group">
										<label class="nott ls0 fw-normal" for="recipe-contactform-name">Name <small>*</small></label>
										<input type="text" id="name" name="name" value="" class="form-control form-control-pill required" />
									</div>

									<div class="col-md-6 form-group">
										<label class="nott ls0 fw-normal" for="recipe-contactform-email">Email <small>*</small></label>
										<input type="email" id="email" name="email" value="" class="required email form-control form-control-pill" />
									</div>

									<div class="w-100"></div>

									<div class="col-md-6 form-group">
										<label class="nott ls0 fw-normal" for="recipe-contactform-phone">Phone</label>
										<input type="text" id="phone" name="phone" value="" class="form-control form-control-pill" />
									</div>

									<div class="col-md-6 form-group">
										<label class="nott ls0 fw-normal" for="recipe-contactform-subject">Subject <small>*</small></label>
										<input type="text" id="subject" name="subject" value="" class="required form-control form-control-pill" />
									</div>

									<div class="w-100"></div>

									<div class="col-12 form-group">
										<label class="nott ls0 fw-normal" for="recipe-contactform-message">Message <small>*</small></label>
										<textarea class="required form-control form-control-pill" id="message" name="message" rows="6" cols="30"></textarea>
									</div>

									<div class="col-12 form-group d-none">
										<input type="text" id="recipe-contactform-botcheck" name="recipe-contactform-botcheck" value="" class="form-control form-control-pill" />
									</div>

									<div class="col-12 form-group center pt-4">
										<button class="button button-circle button-large m-0" type="submit" id="submit" name="submit" value="submit">Send Message</button>
									</div>

								</form>
							</div>
		
							</div>
						</div>
					</section>
					<div class="container p-5 pt-0">
  <div class="row">
    <!-- Email Section -->
    <div class="col-lg-4 center">
      <div class="pt-5">
        <img src="one-page/images/works/email.png" style="height: 4rem" />
      </div>
      <p class="pt-2 ps-4 about-title mb-2">Email Address:</p>
      <!-- <a href="mailto:contact@longmilefashions.com" class="ps-4 about-content">contact@longmilefashions.com</a> -->
	  <a href="mailto:nakulan@longmilefashions.com" class="ps-4 about-content">nakulan@longmilefashions.com</a>
	  <a href="mailto:admin@longmilefashions.com" class="ps-4 about-content">admin@longmilefashions.com</a>
    </div>

    <!-- Factory Section -->
    <div class="col-lg-4 center">
      <div class="pt-5">
        <img src="one-page/images/works/factory.jpg" style="height: 4rem" />
      </div>
      <p class="pt-2 ps-4 about-title mb-2">Factory:</p>
      <p class="ps-4 about-content">
        2/95, Karumandakavandanoor, Uthukuli RS, <br />
        Tirupur, Tamilnadu, India - 638052
      </p>
    </div>

    <!-- Regd Office Section -->
    <div class="col-lg-4 center">
      <div class="pt-5">
        <img src="one-page/images/works/location.png" style="height: 4rem" />
      </div>
      <p class="pt-2 ps-4 about-title mb-2">Regd Office:</p>
      <p class="ps-4 about-content">
        82/2, Whitefields, RS Road, <br />
        Perundurai, Tamilnadu, India - 638052
      </p>
    </div>
  </div>
</div>
				</div>
			</section><!-- #content end -->

			<!-- Footer
			============================================= -->
			<footer id="footer" class="bg-dark py-5" style="background-color: #052342 !important;">
				<div class="container">
					<div class="row g-4">
						<!-- Logo Column -->
						<div class="col-12 col-md-4 d-flex flex-column align-items-center align-items-md-start">
							<img src="one-page/images/logo/longmilenew.png" alt="Longmile Logo" class="img-fluid mb-4" style="width: 18rem;">
							<img src="one-page/images/logo/Ananda.png" alt="Ananda Logo" class="img-fluid" style="width: 22rem;">
						</div>

						<!-- Navigation Links Column -->
						<div class="col-12 col-md-4">
							<div class="row">
								<!-- Enquiry Section -->
								<div class="col-6">
									<h4 class="text-white fw-bold mb-3">Enquiry</h4>
									<ul class="list-unstyled mb-0">
										<li class="mb-2"><a href="contact.php" class="text-white text-decoration-none">Contact us</a></li>
										<li><a href="aboutus.html" class="text-white text-decoration-none">About us</a></li>
									</ul>
								</div>
								<!-- About Section -->
								<div class="col-6">
									<h4 class="text-white fw-bold mb-3">About</h4>
									<ul class="list-unstyled mb-0">
										<li class="mb-2"><a href="capabilities.html" class="text-white text-decoration-none">Capabilities</a></li>
										<li class="mb-2"><a href="commitment.html" class="text-white text-decoration-none">Commitment</a></li>
										<li><a href="menswear.html" class="text-white text-decoration-none">Products</a></li>
									</ul>
								</div>
							</div>
						</div>

						<!-- Address Column -->
						<div class="col-12 col-md-4">
							<h4 class="text-white fw-bold mb-3">Address</h4>
							<div class="row">
								<!-- Factory Address -->
								<div class="col-12 col-md-6 mb-3 mb-md-0">
									<p class="text-white mb-2 fw-bold">Factory:</p>
									<address class="text-white mb-0">
										2/95, Karumandakavandanoor,<br>
										Uthukuli RS, Tirupur,<br>
										Tamilnadu, India - 638052
									</address>
								</div>
								<!-- Registered Office -->
								<div class="col-12 col-md-6">
									<p class="text-white mb-2 fw-bold">Regd Office:</p>
									<address class="text-white mb-0">
										82/2, Whitefields, RS Road,<br>
										Perundurai, Tamilnadu,<br>
										India - 638052
									</address>
								</div>
								
							</div>
							<!-- Social Media -->
							<div class="mt-3">
								<a href="https://www.linkedin.com/company/longmilefashions/" 
								class="social-icon inline-block border-0 si-small si-linkedin text-white"
								style="background-color: #34424f; border-radius:100%" title="linkedin">
									<i class="icon-linkedin text-white"></i>
								</a>
							</div>
						</div>
					</div>

					<!-- Copyright -->
					<div class="row mt-5">
						<div class="col-12 text-center">
							<p class="text-white mb-0">&copy; 2024 Longmile Fashions. All rights reserved.</p>
						</div>
					</div>
				</div>
			</footer>

		</div><!-- #wrapper end -->

		<!-- Go To Top
		============================================= -->
		<div id="gotoTop" class="icon-angle-up rounded-circle"></div>

		<!-- JavaScripts
		============================================= -->
		<!-- <script src="js/jquery.js"></script> -->
		<script src="js/plugins.min.js"></script>

		<!-- Footer Scripts
		============================================= -->
		<script src="js/functions.js"></script>

	</body>
</html>