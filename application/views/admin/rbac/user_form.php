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
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-username"><?php echo $column_username; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="username" placeholder="<?php echo $entry_username; ?>"
                                   id="input-username" class="form-control"
                                   value="<?php echo set_value('username') ? set_value('username') : $username; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-new_password"><?php echo $column_new_password; ?></span></label>
                        <div class="col-sm-10">
                            <input type="password" name="new_password" placeholder="<?php echo $entry_new_password; ?>"
                                   id="input-password" class="form-control"
                                   value="<?php echo set_value('new_password') ? set_value('new_password') : $new_password; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-confirm_password"><?php echo $column_confirm_password; ?></span></label>
                        <div class="col-sm-10">
                            <input type="password" name="confirm_password"
                                   placeholder="<?php echo $entry_confirm_password; ?>" id="input-confirm_password"
                                   class="form-control"
                                   value="<?php echo set_value('confirm_password') ? set_value('confirm_password') : $confirm_password; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-fullname"><?php echo $column_fullname; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="fullname" placeholder="<?php echo $entry_fullname; ?>"
                                   id="input-fullname" class="form-control"
                                   value="<?php echo set_value('fullname') ? set_value('fullname') : $fullname; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email"><?php echo $column_email; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="email" placeholder="<?php echo $entry_email; ?>" id="input-email"
                                   class="form-control"
                                   value="<?php echo set_value('email') ? set_value('email') : $email; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-image"><?php echo $column_image; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="image" placeholder="<?php echo $entry_image; ?>" id="input-image"
                                   class="form-control"
                                   value="<?php echo set_value('image') ? set_value('image') : $image; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-user_group"><?php echo $column_group; ?></label>
                        <div class="col-sm-10">
                            <select name="user_group" id="input-user_group" class="form-control">
                                <option value="1" <?php echo $user_group == 1 ? 'selected' : '';?>><?php echo $text_wizard;?></option>
                                <option value="2" <?php echo $user_group == 2 ? 'selected' : '';?>><?php echo $text_muggle;?></option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>