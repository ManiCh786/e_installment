<?php

include_once("includes/header.php");
include_once("classes/user.class.php");
// email
// password
if (isset($_POST['login'])) {
    $email  = $_POST['email'];
    $password = $_POST['password'];
    $user = new User();
    $login = $user->Login($email, $password);
    // echo "<script type='text/javascript'>alert('$email')</script>";
}
?>
<script>
    function showHidePassword() {
        var password = document.getElementById('password1');
        var show_eye_icon = document.getElementById('show_eye');
        var hide_eye_icon = document.getElementById('hide_eye');
        hide_eye.classList.remove("d-none");
        hide_eye_icon.style.display = "none";
        show_eye_icon.style.display = "block";
        if (password.type == "password") {
            // password.innerHTMl="text";
            password.type = "text";
            hide_eye_icon.style.display = "block";
            show_eye_icon.style.display = "none";
        } else {
            password.type = "password";
            hide_eye_icon.style.display = "none";
            show_eye_icon.style.display = "block";
        }
    }
</script>
<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Login</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->
    <!--================login_part Area =================-->
    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="signup.php" class="btn_3">Create an Account</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" action="" method="post" >
                                <div class="col-md-12 form-group p_star">
                                <Label class="text-dark font-weight-bold">Email <span class="label label-default text-danger">*</span></Label>
                                    <input type="email" class="form-control" id="" name="email" value="" placeholder="Enter Your Email" required>
                                </div>
                                <div class="col-md-12 form-group p_star mt-4">
                                    <Label class="text-dark font-weight-bold ">Password  <span class="label label-default text-danger">*</span></Label>
                                    <div class="input-group">

                                        <input type="password" name="password" id="password1" placeholder="Password" class="form-control" value="" minlength="8" maxlength="16" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" onclick="showHidePassword();">
                                                <i class="mdi mdi-eye " id="show_eye"></i>
                                                <i class="mdi mdi-eye-off d-none" id="hide_eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password"> -->
                                </div>
                                <div class="col-md-12 form-group mt-4">

                                    <button type="submit" value="submit" name="login" class=" mt-3 btn btn-block bg-danger text-light">
                                        log in
                                    </button>
                                    <!-- <a class="lost_pass" href="#">forget password?</a> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->
</main>
<?php

include_once("includes/footer.php");
?>