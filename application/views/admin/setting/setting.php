<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-setting" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i>
                </button>
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
        <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>', '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');?>
        <?php if ($this->input->get('status')) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting"
                      class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                        <li><a href="#tab_meta" data-toggle="tab"><?php echo $tab_meta; ?></a></li>
                        <li><a href="#tab-mail" data-toggle="tab"><?php echo $tab_mail; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-general">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label"
                                       for="input-name"><?php echo $entry_name; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_name" value="<?php echo $config_name; ?>"
                                           placeholder="<?php echo $entry_name; ?>" id="input-name"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label"
                                       for="input-address"><?php echo $entry_address; ?></label>
                                <div class="col-sm-10">
                                    <textarea name="config_address" placeholder="<?php echo $entry_address; ?>" rows="5"
                                              id="input-address"
                                              class="form-control"><?php echo $config_address; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label"
                                       for="input-email"><?php echo $entry_email; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_email" value="<?php echo $config_email; ?>"
                                           placeholder="<?php echo $entry_email; ?>" id="input-email"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label"
                                       for="input-telephone"><?php echo $entry_telephone; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_telephone" value="<?php echo $config_telephone; ?>"
                                           placeholder="<?php echo $entry_telephone; ?>" id="input-telephone"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-rate"><?php echo $entry_rate; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_rate" value="<?php echo $config_rate; ?>"
                                           placeholder="<?php echo $entry_rate; ?>" id="input-rate" class="form-control"/>
                                </div>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label class="col-sm-2 control-label"-->
                            <!--           for="input-image">--><?php //echo $entry_image; ?><!--</label>-->
                            <!--    <div class="col-sm-10">-->
                            <!--        <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail">-->
                            <!--            <img src="--><?php //echo $config_logo; ?><!--" alt="" title="" data-placeholder="--><?php //echo $placeholder; ?><!--"/>-->
                            <!--        </a>-->
                            <!--        <input type="hidden" name="config_image" value="--><?php //echo $config_image; ?><!--" id="input-image"/>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-auto_register">
                                        <?php echo $entry_auto_register; ?>
                                </label>
                                <div class="col-sm-10">
                                    <select name="config_auto_register" id="input-auto_register" class="form-control">
                                        <?php if ($config_auto_register == 1) { ?>
                                            <option value="0"><?php echo $text_disabled; ?></option>
                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                        <?php } else if ($config_auto_register == 0) { ?>
                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                            <option value="1"><?php echo $text_enabled; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description"><?php echo $entry_description; ?></label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="config_description" placeholder="<?php echo $entry_description; ?>" id="input-description" class="form-control summernote" rows="8"><?php echo $config_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-about"><?php echo $entry_about; ?></label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="config_about" placeholder="<?php echo $entry_about; ?>" id="input-about" class="form-control summernote" rows="8"><?php echo $config_about; ?></textarea>
                                </div>
                            </div>
                            <script>
                                $('#input-description, #input-about').summernote({
                                    height: 200,
                                    lang: 'zh-CN'
                                });
                            </script>
                        </div>
                        <div class="tab-pane" id="tab_meta">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-meta-title"><?php echo $entry_meta_title; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_meta_title" value="<?php echo $config_meta_title; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-meta-description"><?php echo $entry_meta_description; ?></label>
                                <div class="col-sm-10">
                                    <textarea name="config_meta_description" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description" class="form-control"><?php echo $config_meta_description; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-meta-keyword"><?php echo $entry_meta_keyword; ?></label>
                                <div class="col-sm-10">
                                    <textarea name="config_meta_keyword" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword" class="form-control"><?php echo $config_meta_keyword; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-mail">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-protocol">
                                    <span data-toggle="tooltip" data-original-title="<?php echo $help_mail_protocol; ?>">
                                        <?php echo $entry_mail_protocol; ?>
                                    </span>
                                </label>
                                <div class="col-sm-10">
                                    <select name="config_mail_protocol" id="input-mail-protocol" class="form-control">
                                        <?php if ($config_mail_protocol == 'smtp') { ?>
                                            <option value="smtp" selected="selected"><?php echo $text_smtp; ?></option>
                                        <?php } else { ?>
                                            <option value="smtp"><?php echo $text_smtp; ?></option>
                                        <?php } ?>
                                        <?php if ($config_mail_protocol == 'mail') { ?>
                                            <option value="mail" selected="selected"><?php echo $text_mail; ?></option>
                                        <?php } else { ?>
                                            <option value="mail"><?php echo $text_mail; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-parameter"><span
                                        data-toggle="tooltip"
                                        title="<?php echo $help_mail_parameter; ?>"><?php echo $entry_mail_parameter; ?></span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_parameter"
                                           value="<?php echo $config_mail_parameter; ?>"
                                           placeholder="<?php echo $entry_mail_parameter; ?>" id="input-mail-parameter"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-mail-smtp-hostname">
                                    <?php echo $entry_mail_smtp_hostname; ?>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_hostname"
                                           value="<?php echo $config_mail_smtp_hostname; ?>"
                                           placeholder="<?php echo $entry_mail_smtp_hostname; ?>"
                                           id="input-mail-smtp-hostname" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="input-mail-smtp-username"><?php echo $entry_mail_smtp_username; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_username"
                                           value="<?php echo $config_mail_smtp_username; ?>"
                                           placeholder="<?php echo $entry_mail_smtp_username; ?>"
                                           id="input-mail-smtp-username" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="input-mail-smtp-password"><?php echo $entry_mail_smtp_password; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_password"
                                           value="<?php echo $config_mail_smtp_password; ?>"
                                           placeholder="<?php echo $entry_mail_smtp_password; ?>"
                                           id="input-mail-smtp-password" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="input-mail-smtp-port"><?php echo $entry_mail_smtp_port; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_port"
                                           value="<?php echo $config_mail_smtp_port; ?>"
                                           placeholder="<?php echo $entry_mail_smtp_port; ?>" id="input-mail-smtp-port"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"
                                       for="input-mail-smtp-timeout"><?php echo $entry_mail_smtp_timeout; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="config_mail_smtp_timeout"
                                           value="<?php echo $config_mail_smtp_timeout; ?>"
                                           placeholder="<?php echo $entry_mail_smtp_timeout; ?>"
                                           id="input-mail-smtp-timeout" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-alert-email"><span
                                        data-toggle="tooltip"
                                        title="<?php echo $help_mail_alert; ?>"><?php echo $entry_mail_alert; ?></span></label>
                                <div class="col-sm-10">
                                    <textarea name="config_mail_alert" rows="5"
                                              placeholder="<?php echo $entry_mail_alert; ?>" id="input-alert-email"
                                              class="form-control"><?php echo $config_mail_alert; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>