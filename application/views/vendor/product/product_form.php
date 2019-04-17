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
                    <input type="hidden" name="product_id" value="<?php echo $product_id;?>">
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
                               for="input-price"><?php echo $column_price; ?></label>
                        <div class="col-sm-10">
                            <input type="number" name="price" placeholder="<?php echo $entry_price; ?>"
                                   id="input-price" class="form-control"
                                   value="<?php echo set_value('price') ? set_value('price') : $price; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-quantity">
                            <span data-toggle="tooltip" title="" data-original-title="<?php echo $tooltip_quantity;?>">
                                <?php echo $column_quantity; ?>
                            </span>
                        </label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" placeholder="<?php echo $entry_quantity; ?>"
                                   id="input-quantity" class="form-control"
                                   value="<?php echo set_value('quantity') ? set_value('quantity') : $quantity; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-cost"><?php echo $column_cost; ?></label>
                        <div class="col-sm-10">
                            <input type="number" name="cost" placeholder="<?php echo $entry_cost; ?>"
                                   id="input-cost" class="form-control"
                                   value="<?php echo set_value('cost') ? set_value('cost') : $cost; ?>"/>
                        </div>
                    </div>
                    <input type="hidden" name="category" value="1">
                    <!--<div class="form-group required">-->
                    <!--    <label class="col-sm-2 control-label"-->
                    <!--           for="input-image">--><?php //echo $column_image; ?><!--</label>-->
                    <!--    <div class="col-sm-10">-->
                    <!--        <input type="text" name="image" placeholder="--><?php //echo $entry_image; ?><!--"-->
                    <!--               id="input-image" class="form-control"-->
                    <!--               value="--><?php //echo set_value('image') ? set_value('image') : $image; ?><!--"/>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-status"><?php echo $column_status; ?></label>
                        <div class="col-sm-10">
                            <select name="status" id="input-status" class="form-control">
                                <option value="1" <?php echo $status == 1 ? 'selected' : ''; ?>><?php echo $text_enable; ?></option>
                                <option value="0" <?php echo $status == 0 ? 'selected' : ''; ?>><?php echo $text_disable; ?></option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>