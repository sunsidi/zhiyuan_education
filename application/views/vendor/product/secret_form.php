<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-upload" data-toggle="tooltip" title="<?php echo $button_save; ?>"
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
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-upload"
                      class="form-horizontal">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-product"><?php echo $column_product; ?></label>
                        <div class="col-sm-10">
                            <select name="product" id="input-product" class="form-control">
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['product_id']; ?>" <?php echo $myproduct == $product['product_id'] ? 'selected' : ''; ?>>
                                        <?php echo $product['name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-secret"><?php echo $column_secret; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="secret" placeholder="<?php echo $entry_secret; ?>"
                                   id="input-secret" class="form-control"
                                   value="<?php echo set_value('secret') ? set_value('secret') : $secret; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-status"><?php echo $column_status; ?></label>
                        <div class="col-sm-10">
                            <select name="status" id="input-status" class="form-control">
                                <option value="1" <?php echo $status == 1 ? 'selected' : ''; ?>><?php echo $text_used; ?></option>
                                <option value="0" <?php echo $status == 0 ? 'selected' : ''; ?>><?php echo $text_not_used; ?></option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>