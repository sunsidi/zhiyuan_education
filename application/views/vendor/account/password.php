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
                        <label class="col-sm-2 control-label" for="input-old_password">
                            <?php echo $column_old_password; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="password" name="old_password" id="input-old_password" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-new_password">
                            <?php echo $column_new_password; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="password" name="new_password" id="input-new_password" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-confirm">
                            <?php echo $column_confirm; ?>
                        </label>
                        <div class="col-sm-9">
                            <input type="password" name="confirm" id="input-confirm" class="form-control"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>