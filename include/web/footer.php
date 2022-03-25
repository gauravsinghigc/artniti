	<!--footer -->
	<footer class="py-lg-3 py-3 pb-0">
		<br>
		<div class="container-fluid px-lg-5 px-3">
			<div class="row footer-top-w3layouts">
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>About Us</h3>
					</div>
					<div class="footer-text">
						<img src="<?php echo MAIN_LOGO; ?>" class="img-fluid mb-2">
						<div class="contact-info">
							<h4>Location :</h4>
							<p><?php echo SECURE(PRIMARY_ADDRESS, "d"); ?></p>
							<div class="phone">
								<h4>Contact :</h4>
								<p>Phone : <?php echo PRIMARY_PHONE; ?></p>
								<p>Email :
									<a href="mailto:<?php echo PRIMARY_EMAIL; ?>"><?php echo PRIMARY_EMAIL; ?></a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>Quick Links</h3>
					</div>
					<ul class="links">
						<li>
							<a href="<?php echo DOMAIN; ?>">Home</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/collection/">Collection</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/offers/">Offers</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>">About <?php echo APP_NAME; ?></a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/blogs/">Blogs</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/reviews/">Reviews</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/contact-us/">Contact Us</a>
					</ul>
				</div>
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>Usefull Links</h3>
					</div>
					<ul class="links">
						<li>
							<a href="<?php echo DOMAIN; ?>/web/account">My Account</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/cart">My Cart</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/privacy-policy/">Privacy Policy</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/refund-and-cancellation">Refund & Cancellations</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/terms-and-conditions">Terms & Conditions</a>
						</li>
						<li>
							<a href="<?php echo WEB_URL; ?>/enquiry">Have an Enquiry</a>
						</li>
				</div>
				<div class="col-lg-3 footer-grid-w3ls">
					<div class="footer-title">
						<h3>Sign up for your offers</h3>
					</div>
					<div class="footer-text">
						<p>By subscribing to our mailing list you will always get latest news and updates from us.</p>
						<form action="#" method="post">
							<input class="form-control" type="email" name="Email" placeholder="Enter your email..." required="">
							<button class="btn1">
								<i class="far fa-envelope" aria-hidden="true"></i>
							</button>
							<div class="clearfix"> </div>
						</form>
					</div>
					<?php SocialAccounts(); ?>
				</div>
			</div>
			<div class="copyright-w3layouts">
				<p class="copy-right text-center ">&copy; <?php echo date("Y"); ?> <?php echo APP_NAME; ?>. All Rights Reserved | Design by
					<a href="<?php echo DEVELOPER_URL; ?>"> <?php echo DEVELOPED_BY; ?> </a>
				</p>
			</div>
		</div>
	</footer>
	<!-- //footer -->