<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_send; ?>"
                        class="btn btn-primary"><i class="fa fa-send"></i></button>
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
        <?php if ($error_alert) { ?>
            <script>
                $(document).ready(function () {
                    alert('<?php echo $error_alert;?>');
                });
            </script>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user"
                      class="form-horizontal">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-content"><?php echo $column_content; ?></span></label>
                        <div class="col-sm-10">
                            <textarea type="text" name="content" placeholder="<?php echo $entry_content; ?>" id="input-content" class="form-control" rows="8"><?php echo set_value('content') ? set_value('content') : $content; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group required" id="mode">
                        <label class="col-sm-2 control-label"
                               for="input-mode"><?php echo $column_mode; ?></label>
                        <div class="col-sm-10">
                            <select name="mode" id="input-mode" class="form-control">
                                <option value="-1">请选择发送模式</option>
                                <option value="0" ><?php echo $text_group; ?></option>
                                <option value="1" ><?php echo $text_users; ?></option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#input-mode").change(function () {
        var mode = $(this).val();

        if (mode == 1) {
            $('#mode').after("<div class='form-group required' id='user'><label class='col-sm-2 control-label' for='input-user'><?php echo $column_user; ?></label> <div class='col-sm-10'> <input type='text' name='user' placeholder='<?php echo $entry_user; ?>'id='input-user' class='form-control'value='<?php echo set_value('user') ? set_value('user') : $user; ?>'/> </div></div>");
            $('#group').remove();
        } else if (mode == 0) {
            $('#mode').after("<div class='form-group required' id='group'><label class='col-sm-2 control-label'for='input-user'><?php echo $column_user; ?></label><div class='col-sm-10'><select name='user' id='input-user' class='form-control'><?php foreach ($user_groups as $user_group) { ?><option value='<?php echo $user_group['id'];?>'><?php echo $user_group['name'];?></option><?php } ?> </select> </div> </div>");
            $('#user').remove();
        } else {
            $('#group').remove();
            $('#user').remove();
        }
    });
</script>