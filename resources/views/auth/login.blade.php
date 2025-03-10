<!DOCTYPE html>
<html lang="en">

<head>
    <title>FastFiks - Ticket Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="assets/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary ">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material">
                          
                            <div class="auth-box">
                                <div class="text-center">
                                    <!-- <img src="assets/images/auth/logo-dark.png" alt="logo.png"> -->
                                    <img class="img-fluid p-2" style="width:90%"  src="{{ asset('assets/images/logo.png') }}" alt="Theme-Logo" />
                                </div>


                                <hr/>

                                <div class="">
                                    <input type="email" class="form-control" placeholder="Your Email Address">
                                    <span class="md-line"></span>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                                <br>
                                <div class="">
                                    <input type="password" class="form-control" placeholder="Password">
                                    <br>
                                    <span class="md-line"></span>
                                    <div class="invalid-feedback">Please enter your password.</div>
                                </div>

                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <!-- <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a> -->
                                    </div>
                                </div>
                                
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
  
    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="assets/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="assets/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="assets/js/common-pages.js"></script>


    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                e.preventDefault();

                var email = $('input[type="email"]').val();
                var password = $('input[type="password"]').val();
                var remember = $('input[type="checkbox"]').is(':checked');
                if (email === '' || password === '') {
                    $('input[type="email"]').addClass('is-invalid');
                    $('input[type="password"]').addClass('is-invalid');
                    return;
                } else {
                    $('input[type="email"]').removeClass('is-invalid');
                    $('input[type="password"]').removeClass('is-invalid');
                }

                if (!validateEmail(email)) {
                    $('input[type="email"]').addClass('is-invalid');
                    return;
                } else {
                    $('input[type="email"]').removeClass('is-invalid');
                }

                // Show spinner
                var $submitButton = $(this).find('button[type="submit"]');
                $submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                $.ajax({
                    url: '{{ route("login-user") }}',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        remember: remember,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect;
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.email) {
                            $('input[type="email"]').addClass('is-invalid');
                            $('input[type="email"]').next('.invalid-feedback').text(errors.email[0]).show();
                        }
                        if (errors.password) {
                            $('input[type="password"]').addClass('is-invalid');
                            $('input[type="password"]').next('.invalid-feedback').text(errors.password[0]).show();
                        }
                    },
                    complete: function() {
                        // Hide spinner
                        $submitButton.prop('disabled', false).html('Sign in');
                    }
                });
            });

            function validateEmail(email) {
                var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
        });
    </script>


</body>

</html>
