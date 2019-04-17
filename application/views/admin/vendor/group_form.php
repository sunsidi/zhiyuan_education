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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user"
                      class="form-horizontal">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-name"><?php echo $column_name; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="name" placeholder="<?php echo $entry_name; ?>"
                                   id="input-name" class="form-control"
                                   value="<?php echo set_value('name') ? set_value('name') : $name; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-rate"><?php echo $column_rate; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="rate" placeholder="<?php echo $entry_rate; ?>"
                                   id="input-name" class="form-control"
                                   value="<?php echo set_value('rate') ? set_value('rate') : $rate; ?>"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>