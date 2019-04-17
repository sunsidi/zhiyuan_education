<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>"/>
    <?php if ($description) { ?>
        <meta name="description" content="<?php echo $description; ?>"/>
    <?php } ?>
    <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <?php } ?>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <script type="text/javascript" src="javascript/jquery/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="javascript/bootstrap/js/bootstrap.min.js"></script>
    <link type="text/css" href="stylesheet/catalog_stylesheet.css" rel="stylesheet"/>
    <link href="stylesheet/bootstrap.css" type="text/css" rel="stylesheet"/>
    <link href="javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
    <link href="favicon.ico" rel="icon">
    <script src="javascript/common.js" type="text/javascript"></script>
    <?php if ($styles) { ;?>
        <?php foreach ($styles as $style) { ;?>
            <link href="<?php echo $style;?>" type="text/css" rel="stylesheet"></link>
        <?php } ;?>
    <?php } ;?>
    <?php if ($scripts) { ;?>
        <?php foreach ($scripts as $script) { ;?>
            <script src="<?php echo $script;?>" type="text/javascript"></script>
        <?php } ;?>
    <?php } ;?>
</head>
<body>
    <header id="header" class="navbar navbar-static-top">
        <div class="container">
            <nav id="navbar" class="navbar" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target="#example-navbar-collapse">
<!--                            <i class="fa fa-list"></i>-->
                            <span class="sr-only">切换导航</span>
                            <span class="icon-bar" style="background-color: black;"></span>
                            <span class="icon-bar" style="background-color: black;"></span>
                            <span class="icon-bar" style="background-color: black;"></span>
                        </button>
                        <a class="navbar-brand" href="#" style="padding:5px 10px;">
                            <img src="image/logo.gif" alt="Zhiyuan Education" style="height:32px;">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="example-navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Job Seeker <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Browse All Jobs</a></li>
                                    <li><a href="#">Advanced Search</a></li>
                                </ul>
                            </li>
                            <li><a href="">Employers</a></li>
                            <li><a href="">Contact Us</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="" style="padding-top: 10px;"><i class="fa fa-twitter fa-2x"></i></a></li>
                            <li><a href="" style="padding-top: 10px;"><i class="fa fa-facebook-official fa-2x"></i></a></li>
                            <li><a href="">LOG IN</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>