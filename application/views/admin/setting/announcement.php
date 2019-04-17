<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <?php if ($error_alert) { ?>
            <script>
                $(document).ready(function() {
                    alert('<?php echo $error_alert;?>');
                });
            </script>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center">
                                    <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" />
                                </td>
                                <td class="text-left">
                                    <?php echo $column_title; ?>
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
                            <?php if (isset($list)) { ?>
                                <?php foreach ($list as $row) { ?>
                                    <tr class="<?php echo $row['code']?>">
                                        <td class="text-center"><?php if (in_array($row['id'], $selected)) { ?>
                                                <input type="checkbox" name="selected[]" value="<?php echo $row['id']; ?>" checked="checked" />
                                            <?php } else { ?>
                                                <input type="checkbox" name="selected[]" value="<?php echo $row['id']; ?>" />
                                            <?php } ?>
                                        </td>
                                        <td class="text-left"><?php echo $row['title']; ?></td>
                                        <td class="text-left"><?php echo $row['status']; ?></td>
                                        <td class="text-right"><a href="<?php echo $row['edit']; ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>
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
            </div>
        </div>
    </div>
</div>