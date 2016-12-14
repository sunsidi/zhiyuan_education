<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
    <?php if ($description) { ?>
        <meta name="description" content="<?php echo $description; ?>"/>
    <?php } ?>
    <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <?php } ?>
    <title><?php echo $title; ?></title>
    <base href="<?php echo $base; ?>"/>
    <link href="favicon.ico" rel="icon">
    <!-- include jquery -->
    <script type="text/javascript" src="javascript/jquery/jquery-2.1.1.min.js"></script>
    <!-- include libraries BS3 -->
    <script type="text/javascript" src="javascript/bootstrap/js/bootstrap.min.js"></script>
    <link href="stylesheet/bootstrap.css" type="text/css" rel="stylesheet"/>
    <!-- include font-awesome-->
    <link href="javascript/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet"/>
    <!-- include datetimepicker-->
    <script src="javascript/jquery/datetimepicker/moment.js" type="text/javascript"></script>
    <script src="javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <link href="javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen"/>
    <!-- include customer stylesheet-->
    <link type="text/css" href="stylesheet/stylesheet.css" rel="stylesheet" media="screen"/>
    <!--include customer js-->
    <script src="javascript/common.js" type="text/javascript"></script>

    <?php if ($styles) { ;?>
        <?php foreach ($styles as $style) { ;?>
            <link href="<?php echo $style;?>" rel="stylesheet"></link>
        <?php } ;?>
    <?php } ;?>
    <?php if ($scripts) { ;?>
        <?php foreach ($scripts as $script) { ;?>
            <script src="<?php echo $script;?>" type="text/javascript"></script>
        <?php } ;?>
    <?php } ;?>
</head>
<body>
<div id="container">
    <header id="header" class="navbar navbar-static-top">
        <div class="navbar-header">
            <?php if ($logged) { ?>
                <a type="button" id="button-menu" class="pull-left">
                    <i class="fa fa-indent fa-lg"></i>
                </a>
            <?php } ?>
            <a href="<?php echo $home; ?>" class="navbar-brand" style="padding: 5px 10px;">
                <img src="image/logo.jpg" alt="logo.jpg" style="height: 32px;"/>
            </a>
        </div>
        <?php if ($logged) { ?>

            <ul class="nav pull-right">
                <li class="dropdown">
                    <a href="<?php echo $new_resume; ?>" style="display: block; overflow: auto;">
                        <span class="label label-danger pull-left"><?php echo $alerts; ?></span>
                        <i class="fa fa-bell fa-lg"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $logout; ?>">
                        <span class="hidden-xs hidden-sm hidden-md">Log out</span>
                        <i class="fa fa-sign-out fa-lg"></i>
                    </a>
                </li>
            </ul>
        <?php } ?>
    </header>