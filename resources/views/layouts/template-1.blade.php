<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.meta', ['prefixTitle' => 'Template 1'])
    @include('partials.styles', ['path' => 'template1'])
</head>
<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </section><!-- End Top Bar-->
    @yield('content')
    <footer id="footer">
        <div class="container py-4">
          <div class="row">
    
            <div class="col-lg footer-links text-center">
              <h4>Our Social Networks</h4>
              <div class="social-links mt-3">
                <a href="#" class="twitter h3"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook h3"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram h3"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus h3"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin h3"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
    
          </div>
        </div>
        
      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong>2015</strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
        -->
          Designed by <a href="#">Pastigo</a>
        </div>
      </div>
    </footer>
    <!-- End Footer -->
    
    @include('partials.btn-back-to-top')
    {{-- 
        <script src="assets/vendor/aos/aos.js"></script> [done]
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> [done]
        <script src="assets/vendor/glightbox/js/glightbox.min.js"></script> [done]
        <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script> [done]
        <script src="assets/vendor/php-email-form/validate.js"></script> [done]
        <script src="assets/vendor/swiper/swiper-bundle.min.js"></script> [done]
        <script src="assets/js/main.js"></script> [done]
    --}}
    @include('partials.scripts', ['path' => 'template1'])
</body>
</html>