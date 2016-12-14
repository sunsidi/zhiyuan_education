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
            <input type="hidden" name="recruitment_id" id="input-recruitment-id" class="form-control" value="<?php echo $recruitment_id; ?>"/>
            <input type="hidden" name="school_id" id="input-school-id" class="form-control" value="<?php echo $school_id; ?>"/>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-name"><?php echo $column_name; ?></label>
              <div class="col-sm-10">
                <input type="text" name="title" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" value="<?php echo set_value('title')? set_value('title') : $title; ?>"/>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-type"><?php echo $column_type; ?></span></label>
              <div class="col-sm-5">
                <div class="col-sm-6">
                  <?php echo $column_full_time; ?>
                  <input type="radio" name="type" value="1" class="" <?php echo $type == 1 ? 'checked' : '';?> >
                </div>
                <div class="col-sm-6">
                  <?php echo $column_part_time; ?>
                  <input type="radio" name="type" value="2" class="" <?php echo $type == 2 ? 'checked' : '';?> >
                </div>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-description"><?php echo $column_description; ?></span></label>
              <div class="col-sm-10">
                <textarea type="text" name="description" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control summernote" rows="8"><?php echo set_value('description')? set_value('description') : $description; ?></textarea>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-requirements"><?php echo $column_requirements; ?></label>
              <div class="col-sm-10">
                <input type="text" name="requirements" placeholder="<?php echo $entry_requirements; ?>" id="input-requirements" class="form-control" value="<?php echo set_value('requirements')? set_value('requirements') : $requirements; ?>"/>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-benefits"><?php echo $column_benefits; ?></label>
              <div class="col-sm-10">
                <input type="text" name="benefits" placeholder="<?php echo $entry_benefits; ?>" id="input-benefits" class="form-control" value="<?php echo set_value('benefits')? set_value('benefits') : $benefits; ?>"/>
              </div>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-contact"><?php echo $column_contact; ?></label>
              <div class="col-sm-10">
                <input type="text" name="contact" placeholder="<?php echo $entry_contact; ?>" id="input-contact" class="form-control" value="<?php echo set_value('contact')? set_value('contact') : $contact; ?>"/>
              </div>
            </div>
            <div class="form-group required">
                <label for="input-time" class="col-sm-2 control-label"><?php echo $column_time;?></label>
                <div class="date form_date col-sm-2" data-date="">
                    <input class="form-control" name="endtime" size="16" type="text" value="<?php echo set_value('endtime')? set_value('endtime') : $endtime; ?>">
                    <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                    </span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            <div class="form-group required">
              <label class="col-sm-2 control-label" for="input-contact"><?php echo $column_status; ?></label>
              <div class="col-sm-2">
                  <select name="status" id="status" class="form-control">
                      <option value="1" <?php echo $status==1 ? 'selected' : '';?>><?php echo $column_active;?></option>
                      <option value="0" <?php echo $status==0 ? 'selected' : '';?>><?php echo $column_deactive;?></option>
                  </select>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $('.form_date').datetimepicker({
        pickTime: false,
        format: 'YYYY-MM-DD'
    });
    $(function() {
        $('.summernote').summernote({
            height: 300
        });
    });
</script>