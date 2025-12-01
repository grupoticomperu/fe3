<!doctype html>
<html lang="zxx">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title -->
	<title>Techvio - IT Solutions & Business Services Multipurpose HTML5 Website Template</title>
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<!-- Bootstrap Min CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- Animate Min CSS -->
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<!-- FlatIcon CSS -->
	<link rel="stylesheet" href="assets/css/flaticon.css">
	<!-- Font Awesome Min CSS -->
	<link rel="stylesheet" href="assets/css/fontawesome.min.css">
	<!-- Bootstrap Icon CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-icons.css">
	<!-- Mean Menu CSS -->
	<link rel="stylesheet" href="assets/css/meanmenu.css">
	<!-- Magnific Popup Min CSS -->
	<link rel="stylesheet" href="assets/css/magnific-popup.min.css">
	<!-- Swiper Min CSS -->
	<link rel="stylesheet" href="assets/css/swiper.min.css">
	<!-- Owl Carousel Min CSS -->
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
	<!-- Responsive CSS -->
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

	<!-- Start Preloader Section -->
	<div class="preloader">
		<div class="loader">
			<div class="shadow"></div>
			<div class="box"></div>
		</div>
	</div>
	<!-- End Preloader Section -->

	<!-- Start Navbar Section -->
    @livewire('navigation-index')
	<!-- End Navbar Section -->

    {{ $slot }}

	<!-- Start Footer & Subscribe Section -->
	<section class="footer-subscribe-wrapper">
		<!-- Start Subscribe Section -->
		<div class="subscribe-area">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-md-6">
						<div class="subscribe-content">
							<h2>Sign Up Our Newsletter</h2>
							<p>We Offer An Informative Monthly Technology Newsletter - Check It Out.</p>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<form class="newsletter-form">
							<input type="email" class="input-newsletter" name="email" placeholder="Enter Your Email" required autocomplete="off">
							<button type="submit">Subscribe Now</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End Subscribe Section -->
		<!-- Start Footer Section -->
		<div class="footer-area ptb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<a class="footer-logo" href="#">
								<img src="assets/img/logo.png" class="white-logo" alt="logo">
							</a>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco consectetur laboris.</p>
							<ul class="footer-social">
								<li>
									<a href="#"> <i class="fab fa-facebook-f"></i></a>
								</li>
								<li>
									<a href="#"> <i class="fa-brands fa-x-twitter"></i></a>
								</li>
								<li>
									<a href="#"> <i class="fab fa-youtube"></i></a>
								</li>
								<li>
									<a href="#"> <i class="fab fa-linkedin"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Our Services</h3>
							</div>
							<ul class="footer-quick-links">
								<li><a href="#">Startup Solutions</a></li>
								<li><a href="#">Web Development</a></li>
								<li><a href="#">Networking Services</a></li>
								<li><a href="#">SEO Optimization</a></li>
								<li><a href="#">Apps Development</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Useful Links</h3>
							</div>
							<ul class="footer-quick-links">
								<li><a href="about.html">About Us</a></li>
								<li><a href="portfolio.html">Case Study</a></li>
								<li><a href="contact.html">Contact Us</a></li>
								<li><a href="privacy-policy.html">Privacy Policy</a></li>
								<li><a href="terms-condition.html">Terms & Conditions</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<div class="footer-heading">
								<h3>Contact Info</h3>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-phone-call"></i>
								<h3>Phone</h3>
								<span><a href="tel:12345678">080 707 555-321</a></span>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-envelope"></i>
								<h3>Email</h3>
								<span><a href="mailto:demo@example.com">demo@example.com</a></span>
							</div>
							<div class="footer-info-contact">
								<i class="flaticon-placeholder"></i>
								<h3>Address</h3>
								<span>526  Melrose Street, Water Mill, 11976  New York</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Section -->
	</section>
	<!-- End Footer & Subscribe Section -->

	<!-- Start Copy Right Section -->
	<div class="copyright-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-6">
					<p><i class="far fa-copyright"></i> 2024 Techvio - All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 col-md-6">
					<ul>
						<li><a href="terms-condition.html">Terms & Conditions</a></li>
						<li><a href="privacy-policy.html">Privacy Policy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End Copy Right Section -->

	<!-- Start Go Top Section -->
	<div class="go-top">
		<i class="fas fa-chevron-up"></i>
		<i class="fas fa-chevron-up"></i>
	</div>
	<!-- End Go Top Section -->

	<!-- jQuery Min JS -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- Popper Min JS -->
	<script src="assets/js/popper.min.js"></script>
	<!-- Bootstrap Min JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!-- Mean Menu JS  -->
	<script src="assets/js/jquery.meanmenu.js"></script>
	<!-- Appear Min JS -->
	<script src="assets/js/jquery.appear.min.js"></script>
	<!-- CounterUp Min JS -->
	<script src="assets/js/jquery.waypoints.min.js"></script>
	<script src="assets/js/jquery.counterup.min.js"></script>
	<!-- Owl Carousel Min JS -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- Magnific Popup Min JS -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- Isotope Min JS -->
	<script src="assets/js/isotope.pkgd.min.js"></script>
	<!-- Swiper Min JS -->
	<script src="assets/js/swiper.min.js"></script>
	<!-- Vanilla Tilt Min JS -->
	<script src="assets/js/vanilla-tilt.min.js"></script>
	<!-- WOW Min JS -->
	<script src="assets/js/wow.min.js"></script>
	<!-- Main JS -->
	<script src="assets/js/main.js"></script>

</body>

</html>
