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
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-title"><?php echo $column_title; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="title" placeholder="<?php echo $entry_title; ?>"
                                   id="input-title" class="form-control"
                                   value="<?php echo set_value('title') ? set_value('title') : $title; ?>"/>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"
                               for="input-content"><?php echo $column_content; ?></span></label>
                        <div class="col-sm-10">
                            <textarea type="text" name="content" placeholder="<?php echo $entry_content; ?>" id="input-content" class="form-control summernote" rows="8">
                                <?php echo set_value('content') ? set_value('content') : $content; ?>
                            </textarea>
                        </div>
                    </div>
                    <script>
                        $('#input-content').summernote({
                            lang: 'zh-CN'
                        });
                    </script>
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
                    <?php if ($type == 'wiki') { ?>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-priority">
                            <span data-toggle="tooltip" title="" data-original-title="<?php echo $tooltip_priority;?>"><?php echo $column_priority; ?></span>
                        </label>
                        <div class="col-sm-10">
                            <select name="priority" id="input-priority" class="form-control">
                                <option value=""><?php echo $default_priority;?></option>
                                <?php foreach ($priorities as $priority) { ?>
                                    <option value="<?php echo $priority['priority'];?>" 
                                            style="background-color: <?php echo $priority['color'];?>" 
                                        <?php echo $mypriority == $priority['priority'] ? 'selected' : ''; ?>>
                                        <?php echo $priority['name']; ?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($type == 'faq') { ?>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-show">
                                <span data-toggle="tooltip" title="" data-original-title="<?php echo $tooltip_show;?>"><?php echo $column_show; ?></span>
                            </label>
                            <div class="col-sm-10">
                                <select name="show" id="input-show" class="form-control">
                                    <option value="1" <?php echo $show == 1 ? 'selected' : ''; ?>><?php echo $text_show; ?></option>
                                    <option value="0" <?php echo $show == 0 ? 'selected' : ''; ?>><?php echo $text_hidden; ?></option>
                                </select>
                            </div>
                        </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>