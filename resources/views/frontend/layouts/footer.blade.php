<!-- Start of Social section
	============================================= -->
	<section id="ins-social" class="ins-social-section">
		<div class="ins-social-content d-flex align-items-center">
			<div class="ins-social-item">
				<a href="#">
					<img src="{{asset('assets/img/logo/fb.png')}}" alt="">
					<span>Facebook</span>
				</a>
			</div>
			<div class="ins-social-item">
				<a href="#">
					<img src="{{asset('assets/img/logo/ln.png')}}" alt="">
					<span>Linkedin</span>
				</a>
			</div>
			<div class="ins-social-item">
				<a href="#">
					<img src="{{asset('assets/img/logo/tw.png')}}" alt="">
					<span>Twitter</span>
				</a>
			</div>
			<div class="ins-social-item">
				<a href="#">
					<img src="{{asset('assets/img/logo/insta.png')}}" alt="">
					<span>Instagram</span>
				</a>
			</div>
			<div class="ins-social-item">
				<a href="#">
					<img src="{{asset('assets/img/logo/yt.png')}}" alt="">
					<span>Youtube</span>
				</a>
			</div>
			<div class="ins-social-item">
				<a href="#">
					<img src="{{asset('assets/img/logo/wa.png')}}" alt="">
					<span>Whats App</span>
				</a>
			</div>
		</div>
	</section>	
<!-- End of Social section
	============================================= -->
    
<!-- Start of Footer section
	============================================= -->
	<footer id="ins-footer" class="ins-footer-section position-relative">
		<!-- <span class="ins-footer-shape1 position-absolute"><img src="assets/img/shape/fot-sh1.png" alt=""></span>
		<span class="ins-footer-shape2 position-absolute"><img src="assets/img/shape/fot-sh2.png" alt=""></span> -->
		<div class="container">
			<div class="ins-footer-logo-newslatter d-flex align-items-center justify-content-between">
				<div class="ins-footer-email">
					Contact us at  <a href="mailto:info@insurancecareer.in">info@insurancecareer.in</a>
				</div>
				<div class="ins-footer-logo position-relative">
					<a href="/"><img src="{{asset('assets/img/logo/logo1.png')}}" alt=""><span class="logo-vector position-absolute"><img src="assets/img/logo/logo-v.png" alt=""></span></a>
				</div>
				
				<!-- <div class="ins-footer-newslatter position-relative">
					<form action="#" method="get">
						<input type="email" name="email" placeholder="Enter Email Address">
						<button>Sign Up</button>
					</form>
				</div> -->
			</div>
			<!-- <div class="ins-footer-instagram text-center ul-li">
				<ul>
					<li><a href="#"><img src="assets/img/gallery/insta1.png" alt=""></a></li>
					<li><a href="#"><img src="assets/img/gallery/insta2.png" alt=""></a></li>
					<li><a href="#"><img src="assets/img/gallery/insta3.png" alt=""></a></li>
					<li><a href="#"><img src="assets/img/gallery/insta4.png" alt=""></a></li>
					<li><a href="#"><img src="assets/img/gallery/insta5.png" alt=""></a></li>
					<li><a href="#"><img src="assets/img/gallery/insta6.png" alt=""></a></li>
				</ul>
			</div> -->
			<!-- <div class="ins-footer-year pera-content text-center">
				<p>since <i class="fas fa-heart"></i> <span>2023</span></p>
			</div> -->
			<div class="ins-footer-menu-area position-relative">
				<div class="ins-footer-cta d-flex align-items-center ">
					<div class="ins-footer-cta-icon">
						<i class="fas fa-phone-alt"></i>
					</div>
					<div class="ins-footer-cta-text">
						<span class="hd-title text-uppercase">phone</span>
						<span class="hd-value text-uppercase"><a href="tel:011-44748705">011-44748705</a></span>
					</div>
				</div>
				
				<div class="ins-footer-menu text-center ul-li">
					<ul>
						<li><a href="/">home</a></li>
						<li><a href="/about">About</a></li>
						<li><a href="/industry">Know about industry</a></li>
						<li><a href="/privacy">Privacy</a></li>
						<li><a href="/terms">Terms & conditions</a></li>
						<li><a href="/contact">contact</a></li>
					</ul>
				</div>
			</div>
			<div class="ins-footer-copyright d-flex justify-content-between">
				<div class="ins-footer-copyright-text">
					© Copyright ©2023 <a href="https://insurancecareer.in">Insurancecareer.in</a> All Rights Reserved Designed & Developed by <a href="https://zynovvatech.com/">ZynovvaTech</a>
				</div>
				<div class="ins-copy-right-menu ul-li">
					<ul>
						<li><a href="/terms">Terms and conditions</a></li>
						<li><a href="/privacy"> Privacy policy</a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>	
<!-- End of Footer section
	============================================= -->
	<!-- For Js Library -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
	<script>
		var swiper = new Swiper('.swiper', {
		  slidesPerView: getDirectionSlidePreview(),
		  direction: getDirection(),
		  navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		  },
		  on: {
			resize: function () {
			  swiper.changeDirection(getDirection());
			  swiper.slidesLengthChange(getDirectionSlidePreview());
			},
		  },
		});
		function  getDirectionSlidePreview(){
			var windowWidth = window.innerWidth;
			var slide = windowWidth <= 650 ? 1 : windowWidth <= 800 ? 2 :(windowWidth <= 1250 ? 3 : 4);
			return slide ;
		}
	
		function getDirection() {
		  var windowWidth = window.innerWidth;
		  var direction ='horizontal';
	
		  return direction;
		}
	  </script>
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/appear.js') }}"></script>
	<script src="{{ asset('assets/js/slick.js') }}"></script>
	<script src="{{ asset('assets/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets/js/knob.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.filterizr.js') }}"></script>
	<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/rbtools.min.js') }}"></script>
	<script src="{{ asset('assets/js/rs6.min.js') }}"></script>
	<script src="{{ asset('assets/js/jarallax.js') }}"></script>
	<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
	<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.marquee.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
	<script src="{{ asset('assets/js/roundslider.js') }}"></script>
	<script src="{{ asset('assets/js/script.js') }}"></script>
	<script src="{{ asset('assets/js/register.js') }}"></script>
	<script src="{{ asset('assets/js/login.js') }}"></script>
	
	<script>
		$(document).on('click', '.accordion-item', function(){
			$(this).addClass('faq_bg').siblings().removeClass('faq_bg')
		}) 
	</script>
</body>
</html>	