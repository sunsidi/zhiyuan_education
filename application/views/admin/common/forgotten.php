<div id="content">
    <div class="container-fluid"><br/>
        <br/>
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title"><i class="fa fa-repeat"></i> <?php echo $heading_title; ?></h1>
                    </div>
                    <div class="panel-body">
                        <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>', '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); ?>
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="input-email"><?php echo $entry_email; ?></label>
                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="text" name="email" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-captcha"><?php echo $entry_captcha; ?></label>
                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-shield"></i></span>
                                    <input type="text" name="captcha" placeholder="<?php echo $entry_captcha; ?>" id="input-captcha" class="form-control" style="width: 75%;"/>
                                    <img src="<?php echo site_url('catalog/common/home/captcha'); ?>" alt="" id="register_captcha" onclick=this.src="<?php echo site_url('catalog/common/home/captcha') . '/' ?>"+Math.random() style="cursor: pointer;margin-left: 1em;" title="看不清？点击更换另一个验证码。"/>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> <?php echo $button_reset; ?></button>
                                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>