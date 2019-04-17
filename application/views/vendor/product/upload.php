<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-upload" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                        class="btn btn-primary"><i class="fa fa-save"></i></button>
                <button type="button" id="clear" data-toggle="tooltip" title="<?php echo $button_clear; ?>"
                        class="btn btn-danger"><i class="fa fa-eraser"></i></button>
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
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-upload"
                      class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-product"><?php echo $column_product; ?></label>
                        <div class="col-sm-10">
                            <select name="product" id="input-product" class="form-control">
                                <?php foreach ($products as $product) { ?>
                                    <option value="<?php echo $product['product_id']; ?>">
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
                            <textarea type="text" name="secret" placeholder="<?php echo $help_secret; ?>" id="input-secret" class="form-control" rows="15"><?php echo set_value('secret'); ?></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#clear").click(function () {
        $("textarea").val('');
    });
</script>