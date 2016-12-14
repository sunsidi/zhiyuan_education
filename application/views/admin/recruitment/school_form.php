<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-city" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $text_add; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>', '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-city" class="form-horizontal">
            <input type="hidden" name="school_id" id="input-id" class="form-control" value="<?php echo $school_id; ?>"/>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-name"><?php echo $column_name; ?></label>
              <div class="col-sm-10">
                <input type="text" name="name" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" value="<?php echo set_value('name')? set_value('name') : $name; ?>"/>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-description"><?php echo $column_description; ?></span></label>
              <div class="col-sm-10">
                <textarea type="text" name="description" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control summernote" rows="8"><?php echo set_value('description')? set_value('description') : $description; ?></textarea>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-address"><?php echo $column_address; ?></label>
              <div class="col-sm-10">
                <input type="text" name="address" placeholder="<?php echo $entry_address; ?>" id="input-address" class="form-control" value="<?php echo set_value('address')? set_value('address') : $address; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-website"><?php echo $column_website; ?></label>
              <div class="col-sm-10">
                <input type="text" name="website" placeholder="<?php echo $entry_website; ?>" id="input-website" class="form-control" value="<?php echo set_value('website')? set_value('website') : $website; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-tel"><?php echo $column_tel; ?></label>
              <div class="col-sm-10">
                <input type="text" name="tel" placeholder="<?php echo $entry_tel; ?>" id="input-tel" class="form-control" value="<?php echo set_value('tel')? set_value('tel') : $tel; ?>"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label" for="input-email"><?php echo $column_email; ?></label>
              <div class="col-sm-10">
                <input type="text" name="email" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" value="<?php echo set_value('email')? set_value('email') : $email; ?>"/>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    $(function() {
        $('.summernote').summernote({
            height: 300
        });
    });
</script>