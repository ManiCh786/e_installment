<?php
include_once('config/system.config.php');

?>
<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding bg-danger  mt-3">
        <div class="container ">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                    <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                            <!-- logo -->
                            <div class="footer-logo">
                                <a class="text-dark" href="">
                                    <span>

                                        <h2>
                                            <strong class="text-light font-weight-bold"><?= SYS_TITLE_1HALF ?></strong>
                                            <?= SYS_TITLE_2HALF ?>
                                        </h2>
                                    </span>

                                </a>
                            </div>
                            <div class="footer-tittle text-light">
                                <div class="footer-pera text-light">
                                    <p class="text-light">Asorem ipsum adipolor sdit amet, consectetur adipisicing elitcf sed do eiusmod
                                        tem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Quick Links</h4>
                            <ul class="text-light">
                                <li><a href="#" class="text-light">About</a></li>
                                <li><a href="#"class="text-light" > Offers & Discounts</a></li>
                                <li><a href="#" class="text-light"> Get Coupon</a></li>
                                <li><a href="#" class="text-light"> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>New Products</h4>
                            <ul>
                                <li><a href="#" class="text-light">Woman Cloth</a></li>
                                <li><a href="#" class="text-light">Fashion Accessories</a></li>
                                <li><a href="#"class="text-light" > Man Accessories</a></li>
                                <li><a href="#" class="text-light"> Rubber made Toys</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Support</h4>

                            <ul>
                                <li><a href="#"class="text-light">Frequently Asked Questions</a></li>
                                <li><a href="#"class="text-light">Terms & Conditions</a></li>
                                <li><a href="#"class="text-light">Privacy Policy</a></li>
                                <li><a href="#"class="text-light">Report a Payment Issue</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer bottom -->
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-8 col-md-7">
                    <div class="footer-copy-right">
                        <p class="text-light">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                            </script> All rights reserved | This Website is made with <i class="fa fa-heart text-dark"
                                aria-hidden="true"></i> by <a class="text-light" href="<?= SYS_DEVFB_LINK ?>" target="_blank">M. Umar
                                Farooq & M. GullZaman
                                Khan</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-4 col-md-5">
                    <div class="footer-copy-right f-right">
                        <!-- social -->
                        <div class="footer-social">
                            <a target="_blank" href="<?= SYS_DEVTWITTER_LINK ?>"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="<?= SYS_DEVFB_LINK ?>"><i class="fab fa-facebook-f"></i></a>
                            <a target="_blank" href="<?= SYS_DEVINSTA_LINK ?>"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="<?= SYS_DEVINSTA_LINK ?>"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>
<!--? Search model Begin -->
<div class="search-model-box">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-btn">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" name="searchQry" placeholder="Searching key.....">
        <a href="shop.php?searchQuery"></a>
        </form>
    </div>
</div>
<!-- Search model end -->

<!-- JS here -->
<!-- All JS Custom Plugins Link Here here -->
<script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="./assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="./assets/js/owl.carousel.min.js"></script>
<script src="./assets/js/slick.min.js"></script>

<!-- One Page, Animated-HeadLin -->
<script src="./assets/js/wow.min.js"></script>
<script src="./assets/js/animated.headline.js"></script>
<script src="./assets/js/jquery.magnific-popup.js"></script>

<!-- Scroll up, nice-select, sticky -->
<script src="./assets/js/jquery.scrollUp.min.js"></script>
<script src="./assets/js/jquery.nice-select.min.js"></script>
<script src="./assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="./assets/js/contact.js"></script>
<script src="./assets/js/jquery.form.js"></script>
<script src="./assets/js/jquery.validate.min.js"></script>
<script src="./assets/js/mail-script.js"></script>
<script src="./assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="./assets/js/plugins.js"></script>
<script src="./assets/js/main.js"></script>

</body>

</html>