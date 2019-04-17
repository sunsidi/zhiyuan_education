<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!--Google Fonts link-->
    <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700,700i" rel="stylesheet">-->
    <link rel="stylesheet" href="stylesheet/index/iconfont.css">
    <link rel="stylesheet" href="stylesheet/index/slick/slick.css">
    <link rel="stylesheet" href="stylesheet/index/slick/slick-theme.css">
    <link rel="stylesheet" href="stylesheet/index/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheet/index/jquery.fancybox.css">
    <link rel="stylesheet" href="stylesheet/index/bootstrap.css">
    <link rel="stylesheet" href="stylesheet/index/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet/index/magnific-popup.css">
    <link rel="stylesheet" href="stylesheet/stylesheet.css">
    <!--        <link rel="stylesheet" href="stylesheet/index/bootstrap-theme.min.css">-->

    <!--For Plugins external css-->
    <link rel="stylesheet" href="stylesheet/index/plugins.css"/>

    <!--Theme custom css -->
    <link rel="stylesheet" href="stylesheet/index/style.css">

    <!--Theme Responsive css-->
    <link rel="stylesheet" href="stylesheet/index/responsive.css"/>

    <script src="javascript/index/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar-collapse">

<div class='preloader'>
    <div class='loaded'>&nbsp;</div>
</div>
<div class="culmn">
    <header id="main_menu" class="header navbar-fixed-top">
        <div class="main_menu_bg">
            <div class="container">
                <div class="row">
                    <div class="nave_menu">
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="index.php/catalog/common/home#home">
                                        <img src="image/index/logo.png"/>
                                    </a>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->

                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav navbar-right">
                                        <li><a href="index.php/catalog/common/home#home">首页</a></li>
                                        <li><a href="index.php/catalog/common/home#about">关于我们</a></li>
                                        <li><a href="index.php/catalog/common/home#faqs">FAQs</a></li>
                                        <li><a href="index.php/catalog/common/home#contact">联系我们</a></li>
                                    </ul>
                                </div>

                            </div>
                        </nav>
                    </div>
                </div>

            </div>

        </div>
    </header> <!--End of header -->


    <!--home Section -->
    <section id="home" class="home">
        <div class="overlay">
            <div class="home_skew_border">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="main_home_slider text-center">
                                <div class="single_home_slider">
                                    <div class="main_home wow fadeInUp" data-wow-duration="700ms">
                                        <h1>欢迎来到<?php echo $title; ?></h1>
                                        <div class="separator"></div>
                                        <p><?php echo $config_description; ?></p>
                                        <div class="home_btn">
                                            <?php if ($logged_in) { ?>
                                                <a href="<?php echo $vendor_url;?>" class="btn btn-lg"><?php echo $fullname;?></a>
                                            <?php } else { ?>
                                            <button id="login" type="button" class="btn btn-lg">登陆</button>
                                            <button id="register" type="button" class="btn btn-default">注册</button>
                                            <?php }?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scrooldown">
                    <a href="#feature"><i class="fa fa-arrow-down"></i></a>
                </div>
            </div>
        </div>
    </section><!--End of home section -->


    <!--feature section -->
    <section id="feature" class="feature sections">
        <div class="container">
            <div class="row">
                <div class="main_feature text-center">

                    <div class="col-sm-3">
                        <div class="single_feature">
                            <div class="single_feature_icon">
                                <i class="fa fa-credit-card"></i>
                            </div>

                            <h4>在线支付</h4>
                            <div class="separator3"></div>
                            <p>支持支付宝、微信在线支付</p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="single_feature">
                            <div class="single_feature_icon">
                                <i class="fa fa-cny"></i>
                            </div>

                            <h4>一键提现</h4>
                            <div class="separator3"></div>
                            <p>一键提现，安全快捷</p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="single_feature">
                            <div class="single_feature_icon">
                                <i class="fa fa-lock"></i>
                            </div>
                            <h4>安全保障</h4>
                            <div class="separator3"></div>
                            <p>全方位技术支撑，使您安全无忧</p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="single_feature">
                            <div class="single_feature_icon">
                                <i class="fa fa-comments-o"></i>
                            </div>

                            <h4>在线客服</h4>
                            <div class="separator3"></div>
                            <p>客户至上，诚信为首</p>
                        </div>
                    </div>

                </div>
            </div>
        </div><!--End of container -->
    </section><!--End of feature Section -->
    <hr/>


    <!-- about section -->
    <section id="about" class="history sections">
        <div class="container">
            <div class="row">
                <div class="main_history">
                    <div class="col-sm-6">
                        <div class="single_history_img">
                            <img src="image/index/stab1.png" alt=""/>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="single_history_content">
                            <div class="head_title">
                                <h2>关于我们</h2>
                            </div>
                            <p><?php echo $config_about; ?></p>

                            <!--<a href="" class="btn btn-lg">BROWSE OUR WORK</a>-->
                        </div>
                    </div>
                </div>
            </div><!--End of row -->
        </div><!--End of container -->
    </section><!--End of history -->

    <!-- service Section -->
    <section id="faqs" class="service">
        <div class="container-fluid">
            <div class="row">
                <div class="main_service">
                    <div class="col-md-6 col-sm-12 no-padding">

                        <div class="single_service single_service_text text-right">
                            <div class="head_title">
                                <h2>FAQs</h2>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-10 col-xs-10 margin-bottom-60">
                                    <div class="row">
                                        <?php foreach ($faqs as $faq) { ?>
                                            <div class="col-sm-10 col-sm-offset-1 col-xs-9 col-xs-offset-1">
                                                <article class="single_service_right_text">
                                                    <h4><?php echo $faq['question']; ?></h4>
                                                    <p><?php echo $faq['answer']; ?></p>
                                                </article>
                                            </div>
                                            <div class="col-sm-1 col-xs-1">
                                                <figure class="single_service_icon">
                                                    <i class="fa fa-heart"></i>
                                                </figure><!-- End of figure -->
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div><!-- End of col-sm-12 -->
                            </div>
                        </div>
                    </div><!-- End of col-sm-6 -->

                    <div class="col-md-6 col-sm-12 no-padding">
                        <figure class="single_service single_service_img">
                            <div class="overlay-img"></div>
                            <img src="image/index/servicerightimg.jpg" alt=""/>
                        </figure><!-- End of figure -->
                    </div><!-- End of col-sm-6 -->

                </div>
            </div><!-- End of row -->
        </div><!-- End of Container-fluid -->
    </section><!-- End of service Section -->

    <!--contant us section-->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact_contant sections">
                        <div class="text-center">
                            <h2>联系我们</h2>
                            <div class="subtitle">
                                客户至上，我们为您提供最全面的技术支撑!
                            </div>
                            <div class="separator"></div>
                        </div><!-- End off Head_title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main_contact_info">
                                    <div class="row">
                                        <div class="contact_info_content padding-top-90 padding-bottom-60 p_l_r">
                                            <div class="col-sm-4 text-center">
                                                <div class="single_contact_info">
                                                    <div class="single_info_text">
                                                        <?php if ($config_telephone) { ?>
                                                            <h3>联系电话</h3>
                                                            <h4><?php echo $config_telephone; ?></h4>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <div class="single_contact_info">
                                                    <div class="single_info_text">
                                                        <?php if ($config_email) { ?>
                                                            <h3>电子邮箱</h3>
                                                            <h4><?php echo $config_email; ?></h4>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <div class="single_contact_info">
                                                    <div class="single_info_text">
                                                        <?php if ($config_qq) { ?>
                                                            <h3>客服QQ</h3>
                                                            <h4><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $config_qq; ?>&site=<?php echo $title;?>&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:285913210:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></h4>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End of contact section -->

    <section id="trial" class="trial text-center wow fadeIn" data-wow-duration="2s" data-wow-dealy="1.5s">
        <div class="main_trial_area">
            <div class="video_overlay sections">
                <div class="container">
                    <div class="row">
                        <div class="main_trial">
                            <div class="col-sm-12">
                                <h2>加入我们！</h2>
                                <h4>快速注册，自动发卡，一键提现，全程无忧！现在就加入我们，开始您的电商之旅!</h4>
                                <button id="register2" type="button" class="btn btn-lg">注册</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End of Trial section -->


    <!--Footer section-->
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main_footer">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <div class="flowus text-center">
                                    <a href=""><?php echo $text_footer; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End off footer Section-->
</div>
<!-- START SCROLL TO TOP  -->
<div class="scrollup">
    <a href="#"><i class="fa fa-chevron-up"></i></a>
</div>

<script src="javascript/index/vendor/jquery-1.11.2.min.js"></script>
<script src="javascript/index/vendor/bootstrap.min.js"></script>
<script src="javascript/index/jquery.magnific-popup.js"></script>
<script src="javascript/index/jquery.mixitup.min.js"></script>
<script src="javascript/index/jquery.easing.1.3.js"></script>
<script src="javascript/index/jquery.masonry.min.js"></script>
<!--slick slide js -->
<script src="stylesheet/index/slick/slick.js"></script>
<script src="stylesheet/index/slick/slick.min.js"></script>
<script src="javascript/index/plugins.js"></script>
<script src="javascript/index/main.js"></script>

<script type="text/template" id="html_template_register">
    <div class="modal fade" id="register_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
        <div class="modal-lg" style="margin: 2em auto 2em auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">注册</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $register; ?>" method="post" enctype="multipart/form-data" id="form-register" class="form-horizontal">
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-username">
                                <?php echo $column_username; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="username" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" value="<?php echo set_value('username'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-email">
                                <?php echo $column_email; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="email" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" value="<?php echo set_value('email'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-telephone">
                                <?php echo $column_telephone; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="number" name="telephone" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" value="<?php echo set_value('telephone'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-qq">
                                <?php echo $column_qq; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="number" name="qq" placeholder="<?php echo $entry_qq; ?>" id="input-qq" class="form-control" value="<?php echo set_value('qq'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-password">
                                <?php echo $column_password; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="password" name="password" placeholder="<?php echo $entry_password; ?>" id="input-register-password" class="form-control" value="<?php echo set_value('password'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-confirm">
                                <?php echo $column_confirm; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="password" name="confirm" placeholder="<?php echo $entry_confirm; ?>" id="input-register-confirm" class="form-control" value="<?php echo set_value('confirm'); ?>"/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-bank">
                                <?php echo $column_bank; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="bank" placeholder="<?php echo $entry_bank; ?>" id="input-bank" class="form-control" value="<?php echo set_value('bank'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-bank_city">
                                <?php echo $column_bank_city; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="bank_city" placeholder="<?php echo $entry_bank_city; ?>" id="input-bank_city" class="form-control" value="<?php echo set_value('bank_city'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-bank_address">
                                <?php echo $column_bank_address; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="bank_address" placeholder="<?php echo $entry_bank_address; ?>" id="input-bank_address" class="form-control" value="<?php echo set_value('bank_address'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-account">
                                <?php echo $column_account; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="number" name="account" placeholder="<?php echo $entry_account; ?>" id="input-account" class="form-control" value="<?php echo set_value('account'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-realname">
                                <?php echo $column_realname; ?>
                            </label>
                            <div class="col-sm-9">
                                <input type="text" name="realname" placeholder="<?php echo $entry_realname; ?>" id="input-realname" class="form-control" value="<?php echo set_value('realname'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-captcha">
                                <?php echo $column_captcha; ?>
                            </label>
                            <div class="col-sm-5">
                                <input type="text" name="captcha" placeholder="<?php echo $entry_captcha; ?>" id="input-register-captcha" class="form-control" value="<?php echo set_value('captcha'); ?>"/>
                            </div>
                            <div class="col-sm-4" id="captcha">
                                <img src="<?php echo site_url('catalog/common/home/captcha');?>" alt="" id="register_captcha" onclick= this.src="<?php echo site_url('catalog/common/home/captcha').'/'?>"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-lg btn" onclick="register();$('#input-register-captcha').val('');$('#input-register-password').val('');$('#input-register-confirm').val('');">确定</button>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/template" id="html_template_login">
    <div class="modal fade" id="login_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">登陆</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $login; ?>" method="post" enctype="multipart/form-data" id="form-login" class="form-horizontal">
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-username">
                                <?php echo $column_username; ?>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="username" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" value="<?php echo set_value('username'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-password">
                                <?php echo $column_password; ?>
                            </label>
                            <div class="col-sm-10">
                                <input type="password" name="password" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-captcha">
                                <?php echo $column_captcha; ?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" name="captcha" placeholder="<?php echo $entry_captcha; ?>" id="input-captcha" class="form-control"/>
                            </div>
                            <div class="col-sm-4">
                                <img src="<?php echo site_url('catalog/common/home/captcha');?>" alt="" id="login_captcha" onclick= this.src="<?php echo site_url('catalog/common/home/captcha').'/'?>"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="show_forgotten();" style="position: absolute; left: 15px; bottom: 15px;">忘记密码</button>
                    <button type="submit" class="btn-lg btn" onclick="login();$('#input-captcha').val('');$('#input-password').val('');">确定</button>
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/template" id="html_template_forgotten">
    <div class="modal fade" id="forgotten_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">找回密码</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $forgotten; ?>" method="post" enctype="multipart/form-data" id="form-forgotten" class="form-horizontal">
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-username">
                                <?php echo $column_username; ?>
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="username" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control" value="<?php echo set_value('username'); ?>"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-captcha">
                                <?php echo $column_captcha; ?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" name="captcha" placeholder="<?php echo $entry_captcha; ?>" id="input-captcha" class="form-control" value="<?php echo set_value('captcha'); ?>"/>
                            </div>
                            <div class="col-sm-4">
                                <img src="<?php echo site_url('catalog/common/home/captcha');?>" alt="" id="forgotten_captcha" onclick= this.src="<?php echo site_url('catalog/common/home/captcha').'/'?>"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-lg btn" onclick="forgotten();">找回密码</button>
                </div>
            </div>
        </div>
    </div>
</script>
<script>

    $('#register, #register2').click(function () {
        if ($("#register_form").length <= 0) { // make sure before append element, element does not exist
            var html = $("#html_template_register").html();
            $("#trial").after(html);
            $("#register_form").modal('show');
        } else {
            $('.alert').remove();
            $("#register_form").modal('show');
        }
    });

    $('#login').click(function () {
        if ($("#login_form").length <= 0) { // make sure before append element, element does not exist
            var html = $("#html_template_login").html();
            $("#trial").after(html);
            $("#login_form").modal('show');
        } else {
            $('.alert').remove();
            $("#login_form").modal('show');
        }
    });

    function show_forgotten() {
        if ($("#forgotten_form").length <= 0) { // make sure before append element, element does not exist
            var html = $("#html_template_forgotten").html();
            $("#trial").after(html);
            $("#login_form").modal('hide');
            $("#forgotten_form").modal('show');
        } else {
            $('.alert').remove();
            $("#login_form").modal('hide');
            $("#forgotten_form").modal('show');
        }
    }

    function register() {
        $.ajax({
            url:'<?php echo $register;?>',
            type:'post',
            dataType: "json",
            data:$('#form-register').serialize(),
            success:function(json){
                if (json['error']) {
                    $('.alert').remove();
                    for (var i = 0; i < json['msg'].length; i++) {
                        $('#form-register').before('<div class="alert alert-danger" style="padding: 5px 10px; margin-bottom: 10px;"><i class="fa fa-exclamation-circle"></i>' + json['msg'][i] +'<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                    $('#register_captcha').attr('src', '<?php echo site_url('catalog/common/home/captcha').'/'?>');
                } else {
                    $('.alert').remove();
                    $('#register_captcha').attr('src', '<?php echo site_url('catalog/common/home/captcha').'/'?>');
                    $("#register_form").modal('hide');
                    alert(json['msg']);
                }
            }
        });
    }

    function login() {
        $.ajax({
            url:'<?php echo $login;?>',
            type:'post',
            dataType: "json",
            data:$('#form-login').serialize(),
            success:function(json){
                if (json['error']) {
                    $('.alert').remove();
                    for (var i = 0; i < json['msg'].length; i++) {
                        $('#form-login').before('<div class="alert alert-danger" style="padding: 5px 10px; margin-bottom: 10px;"><i class="fa fa-exclamation-circle"></i>' + json['msg'][i] +'<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                    $('#login_captcha').attr('src', '<?php echo site_url('catalog/common/home/captcha').'/'?>');
                } else {
                    window.location.href = json['url'];
                }
            }
        });
    }

    function forgotten() {
        $.ajax({
            url:'<?php echo $forgotten;?>',
            type:'post',
            dataType: "json",
            data:$('#form-forgotten').serialize(),
            success:function(json){
                if (json['error']) {
                    $('.alert').remove();
                    for (var i = 0; i < json['msg'].length; i++) {
                        $('#form-forgotten').before('<div class="alert alert-danger" style="padding: 5px 10px; margin-bottom: 10px;"><i class="fa fa-exclamation-circle"></i>' + json['msg'][i] +'<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                    $('#forgotten_captcha').attr('src', '<?php echo site_url('catalog/common/home/captcha').'/'?>');
                } else {
                    $('.alert').remove();
                    $('#forgotten_captcha').attr('src', '<?php echo site_url('catalog/common/home/captcha').'/'?>');
                    $("#forgotten_form").modal('hide');
                    alert(json['msg']);
                }
            }
        });
    }

</script>

</body>
</html>
