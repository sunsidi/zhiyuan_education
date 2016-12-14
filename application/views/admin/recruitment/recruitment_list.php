<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-manufacturer').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_jobs; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-manufacturer">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center">
                    <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                  </td>
                  <td class="text-left">
                    <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_job; ?></a>
                  </td>
                  <td class="text-left">
                    <?php echo $column_type; ?>
                  </td>
                    <td class="text-center">
                        <?php echo $column_expired; ?>
                    </td>
                  <td class="text-left">
                    <?php echo $column_status; ?>
                  </td>
                  <td class="text-right">
                    <?php echo $column_edit ?>
                  </td>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($jobs)) { ?>
                <?php foreach ($jobs as $job) { ?>
                <tr class="<?php echo $job['class'];?>">
                  <td class="text-center"><?php if (in_array($job['id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $job['id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $job['id']; ?>" />
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php echo $job['title']; ?></td>
                  <td class="text-left"><?php echo $job['type']; ?></td>
                  <td class="text-center">
                    <?php if ($job['expired']) { ?>
                        <i class="fa fa-calendar-check-o fa-2x" style="color: #29A8DE;"></i>
                    <?php } else { ?>
                        <i class="fa fa-calendar-times-o fa-2x" style="color: #f44336;"></i>
                    <?php }?>
                  </td>
                  <td class="text-left"><?php echo $job['status']; ?></td>
                  <td class="text-right"><a href="<?php echo $job['edit']; ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
         <!--  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div> -->
        </div>
      </div>
    </div>
  </div>
</div>