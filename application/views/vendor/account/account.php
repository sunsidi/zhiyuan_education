<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                        class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
                   class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>', '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); ?>
        <?php if ($this->input->get('status')) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $text_success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email">
                            <?php echo $column_email; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="email" id="input-email" class="form-control" value="<?php echo set_value('email') ? set_value('email') : $email; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-telephone">
                            <?php echo $column_telephone; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="phone" id="input-telephone" class="form-control" value="<?php echo set_value('phone') ? set_value('phone') : $phone; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-qq">
                            <?php echo $column_qq; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="qq" id="input-qq" class="form-control" value="<?php echo set_value('qq') ? set_value('qq') : $qq; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-bank">
                            <?php echo $column_bank; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="bank" id="input-bank" class="form-control" value="<?php echo set_value('bank') ? set_value('bank') : $bank; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-bank_city">
                            <?php echo $column_bank_city; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_city" id="input-bank_city" class="form-control" value="<?php echo set_value('bank_city') ? set_value('bank_city') : $bank_city; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-bank_address">
                            <?php echo $column_bank_address; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="bank_address" id="input-bank_address" class="form-control" value="<?php echo set_value('bank_address') ? set_value('bank_address') : $bank_address; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-account">
                            <?php echo $column_account; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="number" name="account" id="input-account" class="form-control" value="<?php echo set_value('account') ? set_value('account') : $account; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-realname">
                            <?php echo $column_realname; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" name="realname" id="input-realname" class="form-control" value="<?php echo set_value('realname') ? set_value('realname') : $realname; ?>"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>