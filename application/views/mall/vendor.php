<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
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
</head>
<style>
    .form-container {
        background: url(http://zh.towerofsaviors.com/files/images/campaign/border/talk_box_top.png) left top repeat-x, url(http://zh.towerofsaviors.com/files/images/campaign/border/talk_box_bottom.png) left bottom repeat-x, url(http://zh.towerofsaviors.com/files/images/campaign/border/talk_box_left.png) left top repeat-y, url(http://zh.towerofsaviors.com/files/images/campaign/border/talk_box_right.png) right top repeat-y, rgba(0, 0, 0, .5);
        color: white;
        padding: 2em 2em 5em 2em;
    }
</style>
<body data-spy="scroll" data-target=".navbar-collapse" style="background: url(image/mall/bg.jpg);">
<div class="culmn">
    <header style="background-color: rgba(34, 61, 97, 0.64);">
        <div class="container">
            <div class="row">
                <div class="nave_menu">
                    <nav class="navbar navbar-default" style="background-color: transparent; border-color: transparent;">
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
                                    <li><a href="javascript:;" style="color: #fff;">查询卡密</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header> <!--End of header -->
</div>
<div class="container form-container">
    <div class="row" id="form-div" style="margin-top: 3em;">
        <form method="post" id="form-vendor" class="form-horizontal">
            <div class="col-sm-6">
                <h3>STEP 1 选择商品</h3>
                <input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $vendor_id; ?>">
                <div class="form-group">
                    <label for="input_qq" class="col-sm-2 control-label">在线客服</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">
                            <?php echo $qq; ?>
                            <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq; ?>&site=点卡商城&menu=yes">
                                <img border="0" src="http://pub.idqqimg.com/wpa/images/counseling_style_52.png" alt="点击这里给我发消息" title="点击这里给我发消息" style="border-radius: 3px;">
                            </a>
                            <span style="padding-left: 5px;">卖家状态:</span>
                            <img src="image/mall/crown5.gif" alt="">
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_product" class="col-sm-2 control-label">商品</label>
                    <div class="col-sm-10">
                        <select name="product" id="product" class="form-control" onchange="getProduct();">
                            <option value="" selected>请选择商品</option>
                            <?php foreach ($products as $product) { ?>
                                <option value="<?php echo $product['product_id']; ?>"><?php echo $product['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_price" class="col-sm-2 control-label">单价</label>
                    <div class="col-sm-10">
                        <p class="form-control-static">¥ <span id="price">0.00</span></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_quantity" class="col-sm-2 control-label">库存</label>
                    <div class="col-sm-10">
                        <p class="form-control-static"><span id="quantity">0</span> 件</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_quantity" class="col-sm-2 control-label">购买数量</label>
                    <div class="col-sm-10">
                        <input type="number" step="1" min="1" max="999" class="form-control" id="input_quantity" name="quantity" placeholder="购买数量">
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_email" class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="input_email" name="email" placeholder="该邮箱是您获取卡密的唯一凭证">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="true" checked> 同意并接受<a href="javascript:;" style="color: red; font-size: 14px;" data-toggle="modal" data-target="#agreement">《商品购买协议》</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h3>STEP 2 支付方式</h3>
                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <?php foreach ($payments as $key => $payment) { ?>
                        <?php if ($payment['status'] == 1) { ?>
                            <?php if ($key == 1) { ?>
                                <li class="active">
                                    <a href="<?php echo '#' . $payment['name']; ?>" data-toggle="tab"><img src="<?php echo $payment['icon']; ?>">
                                        <?php echo $payment['title']; ?>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?php echo '#' . $payment['name']; ?>" data-toggle="tab"><img src="<?php echo $payment['icon']; ?>">
                                        <?php echo $payment['title']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <?php foreach ($payments as $key => $payment) { ?>
                        <?php if ($payment['status'] == 1) { ?>
                            <?php if ($key == 1) { ?>
                                <div class="tab-pane fade in active" id="<?php echo $payment['name']; ?>">
                                    <input name="payment" type="radio" value="<?php echo $payment['value']; ?>">
                                    <img src="<?php echo $payment['image']; ?>" alt="<?php echo $payment['title']; ?>" align="absmiddle">
                                </div>
                            <?php } else { ?>
                                <div class="tab-pane fade in" id="<?php echo $payment['name']; ?>">
                                    <input name="payment" type="radio" value="<?php echo $payment['value']; ?>">
                                    <img src="<?php echo $payment['image']; ?>" alt="<?php echo $payment['title']; ?>" align="absmiddle">
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="col-sm-12 text-center" style="display: none; padding-top: 7em;" id="QR">
                    <h3>扫我支付</h3>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <div class="row center-block">
                    <div class="alert alert-warning text-center" role="alert" style="width: 50%; margin-left: auto; margin-right: auto;">
                        <h3 style="margin-bottom: 0;">应付金额
                            <span style="color: red;"> ¥ </span><span id="total" style="color: red;">0.00</span></h3>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <button type="button" class="btn btn-info btn-lg" onclick="createQRcode();">生成二维码</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <ul id="Tab" class="nav nav-tabs">
                <li class="active">
                    <a href="#guideline" data-toggle="tab"><i class="fa fa-location-arrow"></i> 购买指南</a>
                </li>
                <li class="">
                    <a href="#order" data-toggle="tab"><i class="fa fa-envelope-o"></i> 卡密查询</a>
                </li>
            </ul>

            <div id="TabContent" class="tab-content" style="padding-top: 3em; padding-bottom: 2em">
                <div class="tab-pane fade in active text-center" id="guideline">
                    <span style="font-size: 18px;" class="label label-warning">选择商品，填写E-MAIL</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">选择支付方式</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">扫码支付</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">接收带有卡密的E-MAIL</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">交易成功</span>
                </div>
                <div class="tab-pane fade in text-center" id="order">
                    <span style="font-size: 18px;" class="label label-warning">输入购买时填写的E-MAIL地址</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">点击发送</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">您将收到近30天内所有订单详情</span>
                    <i class="fa fa-arrow-right fa-2x" style="margin: 0 5px;"></i>
                    <span style="font-size: 18px;" class="label label-warning">查询完毕</span>
                </div>
            </div>
        </div>
    </div>
</div>
<footer style="background: black; color: #fff;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div style="padding: 20px 0;">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <?php echo $disclaimer; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="text-center">
                                <a href="http://localhost/dianka/" style="color: white;">点卡商城</a> © 2015-2017 版权所有。
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--modal agreement-->
<div class="modal fade" id="agreement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-center" id="myModalLabel"><?php echo $purchase_agreement->title; ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $purchase_agreement->content; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>

<script>
    function getProduct() {
        $.ajax({
            url: 'index.php/mall/vendor/product',
            type: 'post',
            dataType: "json",
            data: $('#product, #vendor_id'),
            success: function (json) {
                if (json == null) {
                    $('#price').html('0.00');
                    $('#quantity').html('0');
                } else {
                    $('#price').html(json['price']);
                    $('#quantity').html(json['quantity']);
                }
            }
        });
    }
    function createQRcode() {
        $.ajax({
            url: '<?php echo $QR_code;?>',
            type: 'post',
            dataType: "json",
            data: $('#form-vendor').serialize(),
            success: function (json) {
                if (json['error']) {
                    $('.error').remove();
                    $('#QR').css('display', 'none');
                    for (var i = 0; i < json['msg'].length; i++) {
                        $('#form-div').before('<div class="error alert alert-danger" style="padding: 5px 10px; margin-bottom: 10px;"><i class="fa fa-exclamation-circle"></i>' + json['msg'][i] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                } else {
                    $('.error').remove();
                    $('#QR').css('display', 'block');
                    $('#QR').append('<img alt="模式二扫码支付" src="http://paysdk.weixin.qq.com/example/qrcode.php?data=' + json['QRcode'] + '" class="center-block;" style="width: 200px;"/>');
                }
            }
        });
    }
    // set quantity limitations
    $(document).ready(function () {
        var num_txt = $("#input_quantity");
        num_txt.focusout(function () {
            if (num_txt.val() > parseInt($("#quantity").html())) {
                var quantity = parseInt($("#quantity").html());
                num_txt.val(quantity);
            }
            if (num_txt.val() < 1) {
                num_txt.val(1);
            }
        });
    });
    // calculate totals
    $(document).ready(function () {
        $("#input_quantity").focusout(function () {
            var price = parseFloat($("#price").html());
            var quantity = $("#input_quantity").val();
            var total = price * quantity;
            $("#total").html(total.toFixed(2));
        });

        $("#product").change(function () {
            var price = $("#price").html();
            var quantity = $("#input_quantity").val();
            var total = price * quantity;
            $("#total").html(total.toFixed(2));
        });
    });
</script>
</body>
</html>