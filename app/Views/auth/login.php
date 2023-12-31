<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kasir Online</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url('') ?>/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('') ?>/css/style.css">
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

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" action="<?= base_url('/auth') ?>" method="post">
                            <div class="text-center">
                                <!-- <img src="<?= base_url('') ?>/images/auth/logo-dark.png" alt="logo.png"> -->
                                <h3 class="text-dark">Petshop</h3>
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Sign In</h3>
                                    </div>
                                </div>
                                <?php if (session()->getFlashdata('error') !== NULL) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <?php echo session()->getFlashdata('error'); ?>
                                    </div>
                                <?php endif; ?>
                                <hr/>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left" hidden>
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
                                        <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
                                    </div>
                                </div>
                                <hr/>

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

    <script type="text/javascript" src="<?= base_url('') ?>/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('') ?>/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url('') ?>/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url('') ?>/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url('') ?>/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?= base_url('') ?>/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url('') ?>/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?= base_url('') ?>/js/common-pages.js"></script>

    <script type="text/javascript">
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>
</body>

</html>
