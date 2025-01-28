<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/phpmailer/src/Exception.php';
require 'include/phpmailer/src/PHPMailer.php';
require 'include/phpmailer/src/SMTP.php';

if (isset($_POST['submit']))
{
$name = $_POST ['name'];
$phone = $_POST ['phone'];
$email = $_POST ['email'];
$subject = $_POST ['subject'];
$message = $_POST ['message'];

$error = array();

$conn = new mysqli('localhost', 'nakulan', 'nakulan@2023', 'longmile');
// $conn = new mysqli('localhost', 'root', '', 'test');
//Check for connection error
if($conn->connect_error){
  die("Error in DB connection: ".$conn->connect_errno." : ".$conn->connect_error);    
}
$insert = 'INSERT INTO `contact` (`id`, `Name`, `Phone`, `Email`, `Subject`, `Message`) 
		VALUES (`id`, "'.$name.'", "'.$phone.'", "'.$email.'", "'.$subject.'", "'.$message.'")';	
		
		$sql = mysqli_query($conn, $insert);
		if($sql){
		 echo '<script language="javascript">';
            echo 'alert("Your Message successfully sent, we will get back to you ASAP.");';
        // echo 'window.location.go(-1)';
        // echo "Thank you for register u got a noti";
        echo '</script>';
		}
// /* creates object */
// $mail = new PHPMailer;

// $mailid = "contactus@longmilefashions.com";
// $details = "<br><p>UserName: ".$name."</p><br>
// 			<p>Email: ".$email."</p><br>
// 			<p>Phone: ".$phone."</p><br>
//             <p>Message: ".$message."</p>";

// // $mail->IsSMTP();
// $mail->isHTML(true);
// $mail->SMTPDebug = 2;
// $mail->SMTPAuth = false;
// $mail->SMTPAutoTLS = false;
// $mail->Host = "localhost";
// $mail->Port = '25';
// $mail->AddAddress($mailid);
// $mail->Username ="contactus@longmilefashions.com";
// $mail->Password ="Longmile@5888";
// $mail->SetFrom('contactus@longmilefashions.com','Longmile Fashions');
// $mail->AddReplyTo('contactus@longmilefashions.com','Longmile Fashions');
// $mail->Subject = $subject;
// $mail->Body = $details;
// $mail->AltBody = $message;
// if($mail->Send())
// {
//     $rs = mysqli_query($conn, $insert);
//     if($rs){
        
//         // echo '<script language="javascript">';
//         echo 'alert("Your Message successfully sent, we will get back to you ASAP.");';
//         // echo 'window.location.go(-1)';
//         // echo "Thank you for register u got a noti";
//         // echo '</script>';
//     }
// }else{
// 	echo 'Message could not be sent. Mailer Error:' .$mail->ErrorInfo;
// }

//     $recipient = 'longmilefashions@gmail.com';
    
//     $mail = new PHPMailer();
//  try {

//         $mail->isSMTP();
//         $mail->Host = 'smtp.gmail.com';
//         $mail->SMTPAuth = true;
//         $mail->Username = 'longmilefashions@gmail.com';
//         $mail->Password = 'dpvrzoxtaebpwdhm';
//         $mail->SMTPSecure = 'ssl';
//         $mail->Port = 465;
        
//         // $mail->Host = "smtpout.secureserver.net"; 
//         // $mail->SMTPAuth = true;
//         // $mail->Username = 'contactus@maktechnologiesllc.com'; 
//         // $mail->Password = 'maktech2022';  
//         // $mail->SMTPSecure = 'tls';
//         // $mail->Port = 80;  


//           $mail->setFrom($email, $name);
//           $mail->addAddress($recipient);


        
//           $mail->Subject = $subject;
//           $mail->Body = "Name: " . $name . "\nEmail: " . $email . "\nPhone: " .  $phone . "\nSubject: " . $subject . "\n\nMessage: " . $message;
//           $response = "";
//           if ($mail->send()) {
//                           echo 'alert("In Mailer");';

//               $response = "Thank you! Your message has been sent.";
//               echo "<script>alert('" . $response . "');</script>";
//           } else {
//               $response = "Sorry, there was an error sending your message. Please try again later.";
//               $response .= "<br>Error details: " . $mail->ErrorInfo;
//           }
//       } catch (Exception $e) {
//           $response = "Sorry, there was an error sending your message. Please try again later.";
//       }
         
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
			<footer id="footer" class="border-0" style="background-color: #052342;">
    <div class="container clearfix">
        <!-- Footer Widgets -->
        <div class="footer-widgets-wrap">
            <div class="row">
                <!-- Left Section -->
                <div class="col-12 col-md-6">
                    <div class="fw-normal mb-0 text-white">
                        <img src="one-page/images/logo/longmilenew.png" style="width: 18rem;" />
                    </div>
					<div class="mb-0 text-white mt-4 ">
					<img src="one-page/images/logo/Ananda.png" style="width: 22rem;" />
                    </div>
					
                </div>

                <!-- Right Section -->
                <div class="col-12 col-md-6 ps-4 mt-4">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between justify-content-md-end">
                        <!-- Enquiry Section -->
                        <div class="widget widget-twitter-feed m-0">
                            <h4 class="footer-head">Enquiry</h4>
                            <ul class="list-unstyled">
                                <li class="mt-1"><a href="contact.php" class="footer-list">Contact us</a></li>
                                <li class="mt-1"><a href="aboutus.html" class="footer-list">About us</a></li>
                            </ul>
                        </div>

                        <!-- About Section -->
                        <div class="widget widget-twitter-feed m-0">
                            <h4 class="footer-head">About</h4>
                            <ul class="list-unstyled">
                                <li><a href="capabilities.html" class="footer-list">Capabilities</a></li>
                                <li class="mt-1"><a href="commitment.html" class="footer-list">Commitment</a></li>
                                <li class="mt-1"><a href="menswear.html" class="footer-list">Products</a></li>
                            </ul>

                            <!-- Brochure Image -->
                            <div class="pt-2 mb-3">
						
                                <div class="mt-2 p-1">
                                    <a href="[BROCHURE_LINK]" target="_blank" class="footer-list text-white" style="text-decoration: underline;">
                                        Download Brochure
                                    </a>
                                </div>
                            </div>

                            <!-- Social Media -->
                            <div class="pt-2 pl-5 ml-3">
                                <a href="https://www.linkedin.com/company/longmilefashions/"
                                    class="social-icon inline-block border-0 si-small si-linkedin text-white"
                                    style="background-color: #34424f; border-radius:100%" title="linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Copyright Section -->
                <div class="ps-4 pt-4">
                    <span class="copyright">© 2024 Longmile Fashions. All rights reserved.</span>
                </div>
            </div>
        </div>
        <!-- .footer-widgets-wrap end -->
    </div>

    <div class="line m-0"></div>
</footer><!-- #footer end -->

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